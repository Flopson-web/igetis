<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CursoController as AdminCursoController;
use App\Http\Controllers\Admin\ArticuloController as AdminArticuloController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\MensajeController;

// ── Frontend público ─────────────────────────────────────────
Route::get('/',              [HomeController::class,     'index'])->name('home');
Route::get('/cursos',        [CursoController::class,    'index'])->name('cursos.index');
Route::get('/cursos/{slug}', [CursoController::class,    'show'])->name('cursos.show');
Route::get('/blog',          [BlogController::class,     'index'])->name('blog.index');
Route::get('/blog/{slug}',   [BlogController::class,     'show'])->name('blog.show');
Route::get('/contacto',      [ContactoController::class, 'index'])->name('contacto.index');
Route::post('/contacto',     [ContactoController::class, 'store'])->name('contacto.store');

// ── Panel Admin (protegido) ──────────────────────────────────
Route::middleware(['auth'])->prefix('gestion-interna')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('cursos', AdminCursoController::class);
    Route::patch('cursos/{curso}/visibilidad',
        [AdminCursoController::class, 'toggleVisibilidad']
    )->name('cursos.visibilidad');

    Route::resource('articulos',  AdminArticuloController::class);
    Route::resource('categorias', AdminCategoriaController::class)
         ->only(['index', 'store', 'destroy']);

    Route::get('configuracion',  [ConfiguracionController::class, 'index'])->name('configuracion.index');
    Route::post('configuracion', [ConfiguracionController::class, 'update'])->name('configuracion.update');

    Route::get('mensajes',                   [MensajeController::class, 'index'])->name('mensajes.index');
    Route::patch('mensajes/{mensaje}/leido', [MensajeController::class, 'marcarLeido'])->name('mensajes.leido');
    Route::delete('mensajes/{mensaje}',      [MensajeController::class, 'destroy'])->name('mensajes.destroy');
});

require __DIR__.'/auth.php';
