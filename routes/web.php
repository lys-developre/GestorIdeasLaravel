<?php

use App\Http\Controllers\ProfileController;
// importamos el controlador que usara rutas
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('idea.index');
    }
    return view('welcome');
});

// ruta a la pagina de inicio
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// ruta para el controlador que rediredireccionara a la vista de ideas.
Route::get('/ideas', [IdeaController::class, 'index'])->name('idea.index');

// ruta para la vista de creacion de ideas donde obtenemos la info de el formulario.
Route::get('/ideas/crear', [IdeaController::class, 'create'])->name('idea.create');

// ruta con el metodo post para validar e insertar los datos en la db.
Route::post('/ideas/crear', [IdeaController::class, 'store'])->name('idea.store');

//ruta que nos redireciona a la vista de el formulario de edicion de la idea ademas le enviamos en la uri como parametro el id de la idea.
Route::get('/ideas/editar/{idea}', [IdeaController::class, 'edit'])->name('idea.edit');

//creamos la ruta para guardar en la base de datos las ideas editadas.
Route::put('/ideas/actualizar/{idea}', [IdeaController::class, 'update'])->name('idea.update');

//ruta para la vista show ideas
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('idea.show');

//ruta para eliminar la idea
Route::delete('/ideas/{idea}', [IdeaController::class, 'delete'])->name('idea.delete');

//ruta hacia el controlador que se encargara de gestionar los likes.
Route::put('/ideas/{idea}', [IdeaController::class, 'synchronizeLikes'])->name('idea.like');


