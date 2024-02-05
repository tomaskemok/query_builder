<?php

namespace App\Policies;

use App\Models\Palabra;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PalabraPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        $permission = Permission::where('name', 'Listar Palabras')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Palabra  $palabra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Palabra $palabra)
    {
        $permission = Permission::where('name', 'Mostrar Palabras')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $permission = Permission::where('name', 'Crear Palabras')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Palabra  $palabra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Palabra $palabra)
    {
        $permission = Permission::where('name', 'Actualizar Palabras')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Palabra  $palabra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Palabra $palabra)
    {
        $permission = Permission::where('name', 'Eliminar Palabras')->first();
        
        return $permission && $user->can($permission->name);
    }
}
