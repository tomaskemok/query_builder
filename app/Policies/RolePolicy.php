<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        $permission = Permission::withoutGlobalScopes()->where('name', 'Listar Roles')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Role $role)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Mostrar Roles')->first();
        
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
        $permission = Permission::withoutGlobalScopes()->where('name', 'Crear Roles')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $role)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Actualizar Roles')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $role)
    {
        $permission = Permission::withoutGlobalScopes()->where('name', 'Eliminar Roles')->first();
        
        return $permission && $user->can($permission->name);
    }
}
