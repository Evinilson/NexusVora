<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PrivacyComplianceTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_include_cookie_preferences_controls(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('js/klaro-config.js', false);
        $response->assertSee('cdn.kiprotect.com/klaro/v0.7/klaro.js', false);
        $response->assertSee('Gerir cookies');
        $response->assertSee('NexusVoraConsent', false);
    }

    public function test_contact_form_uses_required_unchecked_privacy_checkbox(): void
    {
        $response = $this->get('/contacto');

        $response->assertOk();
        $response->assertSee('<input type="checkbox" class="privacy-input" id="f-privacy" name="privacy" required>', false);
        $response->assertDontSee('id="f-privacy" name="privacy" required checked', false);
    }

    public function test_contact_submission_rejects_missing_privacy_consent(): void
    {
        $response = $this->postJson('/contacto', [
            'name' => 'Cliente Teste',
            'email' => 'cliente@example.com',
            'message' => 'Quero saber mais sobre os serviços.',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('privacy');
    }

    public function test_contact_submission_accepts_explicit_privacy_consent(): void
    {
        Mail::fake();

        $response = $this->postJson('/contacto', [
            'name' => 'Cliente Teste',
            'email' => 'cliente@example.com',
            'message' => 'Quero saber mais sobre os serviços.',
            'privacy' => true,
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('leads', [
            'name' => 'Cliente Teste',
            'email' => 'cliente@example.com',
        ]);

        Mail::assertSent(ContactFormMail::class);
        $this->assertSame(1, Lead::count());
    }
}
