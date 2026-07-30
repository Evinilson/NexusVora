@extends('admin.layout')

@section('title', 'Nova partilha segura')

@section('content')
    <div style="margin-bottom:22px;">
        <a href="{{ route('admin.secure-shares.index') }}" style="color:var(--cyan); font-size:13px; font-weight:700;">← Voltar</a>
        <h2 style="font-size:20px; font-weight:800; margin:12px 0 6px;">Nova partilha segura</h2>
        <p style="margin:0; color:var(--muted); max-width:760px; line-height:1.6;">
            Define o codigo e o prazo de expiracao. O link e os dados ficam cifrados na base de dados.
        </p>
    </div>

    @if($errors->any())
        <div style="background:rgba(251,113,133,.12); border:1px solid rgba(251,113,133,.5); color:#fecdd3; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
            Corrige os campos assinalados antes de guardar.
        </div>
    @endif

    <form method="POST" action="{{ route('admin.secure-shares.store') }}" style="display:grid; gap:18px; max-width:920px;">
        @csrf

        <section style="border:1px solid var(--border); border-radius:8px; background:var(--surface-2); padding:22px; display:grid; gap:16px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label for="title" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Titulo *</label>
                    <input id="title" name="title" value="{{ old('title') }}" required placeholder="Ex: Acesso ao alojamento"
                        style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:11px 13px; border-radius:8px;">
                    @error('title') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="expires_at" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Desaparece em *</label>
                    <input id="expires_at" type="datetime-local" name="expires_at" value="{{ old('expires_at', optional($share->expires_at)->format('Y-m-d\TH:i')) }}" required
                        style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:11px 13px; border-radius:8px;">
                    @error('expires_at') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label for="recipient_name" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Nome do destinatario</label>
                    <input id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}"
                        style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:11px 13px; border-radius:8px;">
                    @error('recipient_name') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="recipient_email" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Email do destinatario</label>
                    <input id="recipient_email" type="email" name="recipient_email" value="{{ old('recipient_email') }}"
                        style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:11px 13px; border-radius:8px;">
                    @error('recipient_email') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="access_code" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Codigo de acesso *</label>
                <div style="display:grid; grid-template-columns:minmax(0, 1fr) auto; gap:10px;">
                    <input id="access_code" name="access_code" value="{{ old('access_code', $generatedAccessCode ?? '') }}" required placeholder="Ex: 482-913"
                        style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:11px 13px; border-radius:8px; font-weight:800; letter-spacing:.08em;">
                    <button type="button" id="generate-access-code"
                        style="background:rgba(0,212,255,.12); border:1px solid rgba(0,212,255,.35); color:var(--cyan); padding:0 14px; border-radius:8px; font-weight:800; cursor:pointer; white-space:nowrap;">
                        Gerar outro
                    </button>
                </div>
                <p style="margin:7px 0 0; color:var(--muted); font-size:12px;">Codigo gerado automaticamente. Envia-o por outro canal, separado do link.</p>
                @error('access_code') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
            </div>
        </section>

        <section style="border:1px solid var(--border); border-radius:8px; background:var(--surface-2); padding:22px; display:grid; gap:16px;">
            <div>
                <label for="secure_url" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Link sensivel</label>
                <input id="secure_url" type="url" name="secure_url" value="{{ old('secure_url') }}" placeholder="https://..."
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:11px 13px; border-radius:8px;">
                @error('secure_url') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="secret_payload" style="display:block; color:var(--muted); font-size:12px; font-weight:700; margin-bottom:6px;">Dados sensiveis</label>
                <textarea id="secret_payload" name="secret_payload" rows="8" placeholder="Credenciais, notas privadas ou instrucoes..."
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:12px 13px; border-radius:8px; resize:vertical;">{{ old('secret_payload') }}</textarea>
                @error('secret_payload') <p style="color:var(--danger); font-size:12px;">{{ $message }}</p> @enderror
            </div>
        </section>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
            <a href="{{ route('admin.secure-shares.index') }}" style="padding:12px 18px; border:1px solid var(--border); border-radius:8px; color:var(--muted);">Cancelar</a>
            <button type="submit" style="padding:12px 20px; border:0; border-radius:8px; background:var(--cyan); color:#00111a; font-weight:800; cursor:pointer;">Criar partilha</button>
        </div>
    </form>

    <script>
        document.getElementById('generate-access-code')?.addEventListener('click', function () {
            var first = Math.floor(100 + Math.random() * 900);
            var second = Math.floor(100 + Math.random() * 900);
            document.getElementById('access_code').value = first + '-' + second;
        });
    </script>
@endsection
