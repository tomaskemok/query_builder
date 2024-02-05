<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Producto extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Producto>
     */
    public static $model = \App\Models\Producto::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'product';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'product',
        'category',
        'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nombre', 'product')
                ->nullable(),

            Text::make('Categoría', 'category')
                ->nullable(),
                
            Text::make('Descripción', 'description')
                ->nullable(),

            Textarea::make('Query')
                ->default(function ($request) {
                    $url = $request->headers->get('referer');
                    $str = parse_url($url, PHP_URL_QUERY);
                    parse_str($str, $output);
                    $query = $output['q'];

                    return $query;
                })
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}