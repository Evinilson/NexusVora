<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\HourPackageController as AdminHourPackageController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SecureShareController as AdminSecureShareController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\SecureShareAccessController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/servicos', function () {
    return view('services');
})->name('services');

foreach (config('nexus-services') as $key => $service) {
    Route::get("/{$service['slug']}", function () use ($service) {
        return view('service-detail', compact('service'));
    })->name("service.{$key}");
}

Route::get('/servicos/trafego-leads-conversoes', function () {
    return view('services.trafego-leads-conversoes');
})->name('service.trafego');

Route::get('/precos', function () {
    return view('precos');
})->name('precos');

Route::get('/sobre-nos', function () {
    return view('sobre');
})->name('sobre');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');
Route::post('/contacto', [\App\Http\Controllers\ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contacto.submit');

Route::get('/termos-servico', function () {
    return view('termos');
})->name('termos');

Route::get('/politica-privacidade', function () {
    return view('privacidade');
})->name('privacidade');

Route::get('/seguro/{token}', [SecureShareAccessController::class, 'show'])->name('secure-shares.public.show');
Route::post('/seguro/{token}', [SecureShareAccessController::class, 'unlock'])
    ->middleware('throttle:6,1')
    ->name('secure-shares.public.unlock');

Route::get('/sitemap.xml', function () {
    $pages = [
        ['route' => 'home',        'file' => 'welcome'],
        ['route' => 'services',    'file' => 'services'],
        ['route' => 'precos',      'file' => 'precos'],
        ['route' => 'sobre',       'file' => 'sobre'],
        ['route' => 'contacto',    'file' => 'contacto'],
        ['route' => 'privacidade', 'file' => 'privacidade'],
        ['route' => 'termos',      'file' => 'termos'],
    ];

    foreach (config('nexus-services') as $key => $service) {
        $pages[] = ['route' => "service.{$key}", 'file' => 'service-detail'];
    }

    $pages[] = ['route' => 'service.trafego', 'file' => 'services/trafego-leads-conversoes'];

    foreach ($pages as &$page) {
        $path = resource_path("views/{$page['file']}.blade.php");
        $page['lastmod'] = date('Y-m-d', File::lastModified($path));
    }

    return response()
        ->view('sitemap', compact('pages'))
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::prefix('nv-console')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.store');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::resource('partilhas-seguras', AdminSecureShareController::class)
            ->only(['index', 'create', 'store', 'destroy'])
            ->names('secure-shares')
            ->parameters(['partilhas-seguras' => 'secureShare']);

        // Clientes
        Route::resource('clientes', AdminClientController::class)->names('clients')->parameters(['clientes' => 'client']);

        // Projetos + tarefas inline
        Route::resource('projetos', AdminProjectController::class)->names('projects')->parameters(['projetos' => 'project']);
        Route::get('/tarefas', [AdminTaskController::class, 'index'])->name('tasks.index');
        Route::post('/projetos/{project}/tarefas', [AdminProjectController::class, 'storeTask'])->name('projects.tasks.store');
        Route::put('/projetos/{project}/tarefas/{task}', [AdminProjectController::class, 'updateTask'])->name('projects.tasks.update');
        Route::delete('/projetos/{project}/tarefas/{task}', [AdminProjectController::class, 'destroyTask'])->name('projects.tasks.destroy');

        // Documentos PDF de projetos
        Route::get('/projetos/{project}/documento/{type}/preview', [AdminDocumentController::class, 'preview'])->name('documents.preview');
        Route::get('/projetos/{project}/documento/{type}/download', [AdminDocumentController::class, 'download'])->name('documents.download');
        Route::post('/projetos/{project}/documento', [AdminDocumentController::class, 'send'])->name('documents.send');

        // Pacotes de Horas
        Route::resource('pacotes-horas', AdminHourPackageController::class)
            ->names('hour-packages')
            ->parameters(['pacotes-horas' => 'hourPackage']);
        Route::post('/pacotes-horas/{hourPackage}/entradas', [AdminHourPackageController::class, 'storeEntry'])->name('hour-packages.entries.store');
        Route::delete('/pacotes-horas/{hourPackage}/entradas/{entry}', [AdminHourPackageController::class, 'destroyEntry'])->name('hour-packages.entries.destroy');
        Route::post('/pacotes-horas/{hourPackage}/tarefas', [AdminHourPackageController::class, 'storeTask'])->name('hour-packages.tasks.store');
        Route::put('/pacotes-horas/{hourPackage}/tarefas/{task}', [AdminHourPackageController::class, 'updateTask'])->name('hour-packages.tasks.update');
        Route::delete('/pacotes-horas/{hourPackage}/tarefas/{task}', [AdminHourPackageController::class, 'destroyTask'])->name('hour-packages.tasks.destroy');
        Route::get('/pacotes-horas/{hourPackage}/pdf/ficha/preview', [AdminHourPackageController::class, 'previewFicha'])->name('hour-packages.pdf.ficha.preview');
        Route::get('/pacotes-horas/{hourPackage}/pdf/ficha/download', [AdminHourPackageController::class, 'downloadFicha'])->name('hour-packages.pdf.ficha.download');
        Route::get('/pacotes-horas/{hourPackage}/pdf/relatorio/preview', [AdminHourPackageController::class, 'previewRelatorio'])->name('hour-packages.pdf.relatorio.preview');
        Route::get('/pacotes-horas/{hourPackage}/pdf/relatorio/download', [AdminHourPackageController::class, 'downloadRelatorio'])->name('hour-packages.pdf.relatorio.download');
        Route::get('/pacotes-horas/{hourPackage}/pdf/tarefas/preview', [AdminHourPackageController::class, 'previewTaskReport'])->name('hour-packages.pdf.tarefas.preview');
        Route::get('/pacotes-horas/{hourPackage}/pdf/tarefas/download', [AdminHourPackageController::class, 'downloadTaskReport'])->name('hour-packages.pdf.tarefas.download');
    });
});
