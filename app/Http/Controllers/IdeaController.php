<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class IdeaController extends Controller
{
    //almacenamos las reglas de validacion.
    private array $rules = [
        'title' => 'required|string|max:100',
        'description' => 'required|string|max:300',
    ];

    //personalizamos los mensajes de error.
    private array $errorMessages = [
        'title.required' => 'El campo titulo es obligatorio',
        'description.required' => 'El campo descripción es obligatorio',
        'string' => 'Este campo solo puede contener datos de tipo string',
        'title.max' => 'El titulo puede contar como maximo con :max caracteres',
        'description.max' => 'La descripción puede contar como maximo con :max caracteres'

    ];

    // con el metodo index extraemos la ideas de la base de datos y las dejamsos disponible en la vista.
    public function index(): View
    {
        $ideas = idea::get();
        return view('ideas.index', ['ideas' => $ideas]);
    }

    // controlador que nos redirige a la vista de creacion de ideas y edicion
    public function create(): View
    {
        return view('ideas.create_or_edit');
    }

    // controlador que se encarga de validar los datos qie vienen de el formulario (Request) e insertarlos en la base de datos.
    public function store(Request $request)
    {
        // Validamos la informacion que proviene de los campos de el formulario y retornamos los mensaje de error personalizados.
        $validated = $request->validate($this->rules, $this->errorMessages);

        //almacenamos en la base de datos los datos validados.
        Idea::create([

            'user_id' => auth()->user()->id,
            'titulo' => $validated['title'],
            'description' => $validated['description'],

        ]);

        // configuramos este helper para que se muestre este mensaje de forma temporal en la session que este iniciada
        session()->flash('message', 'La idea fue creada con exito!');


        return redirect()->route('idea.index');
    }

    //en este metodo recibimos la idea que enviamos por el enrutador y devolvemos la vista con el formulario
    public function edit(Idea $idea): View
    {
        //si en la clase de politicas retornamos true se ejecuta el metodo sino, muestra un error.
        $this->authorize('update', $idea);
        //retornamos la vista junto con la variable ideas
        return view('ideas.create_or_edit')->with('idea', $idea);
    }

    //obtenemos los parametros de la idea editada y la guardamos en la base de datos.
    public function update(Request $request, Idea $idea)
    {   
        //si en la clase de politicas retornamos true se ejecuta el metodo sino muestra un error.
        $this->authorize('update', $idea);

        // Validamos las ideas ya editadas que nos llegan en la request
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:300',
        ]);

        // Creamos un array para asignar los valores correctos
        $dataToUpdate = [
            'titulo' => $validated['title'], // Mapeamos 'title' a 'titulo'
            'description' => $validated['description'],
        ];

        // actualizamos la variable $idea con el metodo update
        $idea->update($dataToUpdate);

        //mostramos el mnsaje de que la idea fue actualizada correctamente
        session()->flash('message', 'La idea fue actualizada con exito!');

        //retornamos la vista con la idea ya editada
        return redirect(route('idea.index'));
    }

    //este controlador retorna la vista show de ideas
    public function show(Idea $idea): View
    {
        return view('ideas.show')->with('idea', $idea);
    }

    //este controlador retorna index una ves eliminada la idea
    public function delete(Idea $idea): RedirectResponse
    {   
        // control de autorizacion
        $this->authorize('delete', $idea);
        
        //eliminamos la idea
        $idea->delete();
        //mostramos el mnsaje de que la idea fue eliminada correctamente
        session()->flash('message', 'La idea fue eliminada con exito!');
        //retornamos la vista que contiene las ideas.
        return redirect()->route('idea.index');
    }

    //metodo para la gestion de los likes tomando la consulta que envia el formulario de el like.
    public function synchronizeLikes(Request $request, Idea $idea): RedirectResponse
    {
        //obtenemos el usuario, definimos la relacion , y añadimos o eliminamos el mg de el usuario.
        $request->user()->ideasLike()->toggle($idea->id);

        // actualizamos la tabla que contiene el numero de likes de la idea
        $idea->update(['likes' => $idea->users()->count()]);

        //retornamos la vista en la que se produjo el like
        return redirect()->route('idea.show',['idea' => $idea->id]);
    }
}
