<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy
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
        $permission = Permission::where('name', 'Listar Productos')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Producto $producto)
    {
        $permission = Permission::where('name', 'Mostrar Productos')->first();
        
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
        $permission = Permission::where('name', 'Crear Productos')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Producto $producto)
    {
        $permission = Permission::where('name', 'Actualizar Productos')->first();
        
        return $permission && $user->can($permission->name);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Producto $producto)
    {
        $permission = Permission::where('name', 'Eliminar Productos')->first();
        
        return $permission && $user->can($permission->name);
    }
}
