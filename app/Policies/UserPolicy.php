<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        $permission = Permission::withoutGlobalScopes()->where('name', 'Listar Usuarios')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        if ($user->id == $model->id)
            return true;
        
        $permission = Permission::withoutGlobalScopes()->where('name', 'Mostrar Usuarios')->first();

        return $permission && $user->can($permission->name) && $model->level >= $user->level;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Crear Usuarios')->first();

        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Actualizar Usuarios')->first();

        return $permission && $user->can($permission->name) && $model->level >= $user->level;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Eliminar Usuarios')->first();

        return $permission && $user->can($permission->name) && $model->level >= $user->level;
    }
}
