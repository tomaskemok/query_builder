<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
        $permission = Permission::withoutGlobalScopes()->where('name', 'Listar Permisos')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Permission $permission)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Mostrar Permisos')->first();
        
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
        $permission = Permission::withoutGlobalScopes()->where('name', 'Crear Permisos')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Permission $permission)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Actualizar Permisos')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Permission $permission)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Eliminar Permisos')->first();
        
        return $permission && $user->can($permission->name);
    }
}
