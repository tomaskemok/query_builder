<?php

namespace App\Models;

use App\Support\Helper;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, Actionable;

    /**
     * Returns all unnecessary permissions
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getUnnecessaryPermissions()
    {
        $permissions = Permission::withoutGlobalScopes()->all()
            ->filter(function ($permission) {
                return !Helper::isPrivateRoute($permission->route_name);
            });

        return $permissions;
    }

    /**
     * Returns all private routes without permission
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getPrivateRoutesWithoutPermission()
    {
        $routes = collect(Route::getRoutes()->getRoutes())
            ->filter(function ($route){
                $permissionExists = Permission::withoutGlobalScopes()->where('route_name', $route->getName())->get()->count();
                // Check and Return if is a private route and don't have any permission
                return in_array('access', $route->gatherMiddleware()) && !$permissionExists;
            });

        return $routes;
    }

    /**
     * Returns the total permissions notifications, counting both
     * unnecessary permissions and private routes without permission
     *
     * @return int
     */
    public static function getTotalPermissionsNotifications()
    {
        $unnecessaryPermissions = self::getUnnecessaryPermissions()->count();
        $privateRoutesWithoutPermission = self::getPrivateRoutesWithoutPermission()->count();
        $totalPermissionsNotifications = $unnecessaryPermissions + $privateRoutesWithoutPermission;

        return $totalPermissionsNotifications;
    }

    /**
     * Convert permissions array or int or string to collection
     *
     * @param string|integer|array ...$permission
     *
     * @return \Illuminate\Support\Collection
     */
    public static function convertPermissionsToCollection(...$permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {

                if (empty($permission)) {
                    return false;
                }

                if (!$permission instanceof Permission) {
                    if (is_numeric($permission)) {
                        $permission = Permission::withoutGlobalScopes()->findById(intval($permission));
                    } elseif (is_string($permission)) {
                        $permission = Permission::withoutGlobalScopes()->findByName($permission);
                    }
                }

                return $permission;
            })
            ->filter(function ($permission)
            {
                return $permission instanceof Permission;
            });

        return $permissions;
    }
}
