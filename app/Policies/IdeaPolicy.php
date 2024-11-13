<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
    /**
     * Descripción: Permite a todos los usuarios ver la lista de ideas.
     * Función: Todos pueden ver todas las ideas.    
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos los usuarios pueden ver la lista de ideas.
    }

    /**
     * Descripción: Solo el creador o un administrador puede ver una idea específica.
     * Función: Permite ver la idea solo si el usuario es el creador o un administrador.
     */
    public function view(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id || $user->is_admin; // Permite ver la idea si es el creador o un administrador.
    }

    /**
     * Descripción: Cualquier usuario autenticado puede crear una nueva idea.
     * Función: Permite a los usuarios que han iniciado sesión crear nuevas ideas.
     */
    public function create(User $user): bool
    {
        return $user->is_authenticated; // Solo usuarios autenticados pueden crear nuevas ideas.
    }

    /**
     * Descripción: Solo el creador de la idea puede modificarla.
     * Función: Permite la actualización de la idea solo si el usuario es el propietario.
     */
    public function update(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id; // Permite la actualización solo si el usuario es el propietario.
    }

    /**
     * Descripción: Solo el creador de la idea puede eliminarla.
     * Función: Permite la eliminación de la idea solo si el usuario es el propietario.
     */
    public function delete(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id; // Permite la eliminación solo si el usuario es el propietario.
    }

    /**
     * Descripción: Solo el creador o un administrador puede restaurar una idea eliminada.
     * Función: Permite restaurar la idea solo si el usuario es el creador o un administrador.
     */
    public function restore(User $user, Idea $idea): bool
    {
        return $user->id === $idea->user_id || $user->is_admin; // Permite restaurar si es el creador o un administrador.
    }

    /**
     * Descripción: Solo el creador o un administrador pueden darle like a las ideas si no son de su propiedad.
     * 
     */
    public function updateLikes(User $user, Idea $idea): bool
    {
        return $idea->user()->isNot($user);
    }
}