<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdeaController extends Controller
{
    // con el metodo index extraemos la ideas de la base de datos y las dejamsos disponible en la vista
    public function index(): View
    {
        $ideas = idea::get();
        return view('ideas.index', ['ideas' => $ideas]);
    }

    // controlador que nos redirige a la vista de creacion de ideas
    public function create(): View
    {
        return view('ideas.create');
    }

    // controlador que se encarga de validar los datos qie vienen de el formulario (Request) e insertarlos en la base de datos.
    public function store(Request $request)
    {
        // Validamos la informacion que proviene de los campos de el formulario.
        $validated = $request->validate([

                'title' => 'required|string|max:100',
                'description' => 'required|string|max:300',
            
            ]);

        //almacenamos en la base de datos los datos validados.
        Idea::create([

            'user_id' => auth()->user()->id,
            'titulo' => $validated['title'],
            'description' => $validated['description'],

        ]);

        return redirect()->route('idea.index');
    }
}
