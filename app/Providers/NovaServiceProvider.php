<?php

namespace App\Providers;

use Acme\GenerarQuery\GenerarQuery;
use App\Nova\Palabra;
use App\Nova\Permission;
use App\Nova\Role;
use App\Nova\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::userMenu(function (Request $request, Menu $menu) {
            
            $menu->prepend(
                MenuItem::make(
                    __('Mi Perfil'),
                    "/resources/users/{$request->user()->getKey()}"
                )
            );

            return $menu;
        });

        Nova::mainMenu(function (Request $request) {
            return [

                MenuSection::make('Menu', [
                ])->icon('view-list')->collapsable(),

                MenuSection::make(__('Usuarios'), [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Role::class),
                    MenuItem::resource(Permission::class),
                ])->icon('users')->collapsable(),

                MenuSection::make(__('Recursos'), [
                    MenuItem::resource(Palabra::class),
                ])->icon('view-list'),
                
                MenuSection::make(__('Importar'), [
                    MenuItem::link('Generar Query', '/generar-query')
                ])->icon('cash')
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->isAdmin();
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new GenerarQuery,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->gate();

        Nova::auth(function ($request) {
            return Gate::check('viewNova', [$request->user()]);
        });
    }
}
