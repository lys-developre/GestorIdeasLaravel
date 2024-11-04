<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdeaController extends Controller
{   
    // con el metodo index extraemos la ideas de la base de datos y las dejamsos disponible en la vista
    public function index()
    {
        $ideas = DB::table('ideas')->get(); 
        return view('ideas.index', ['ideas' => $ideas]); 
    }
}
