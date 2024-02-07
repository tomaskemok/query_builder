<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearProductoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (request()->ajax()) {
            $baseUrl = config('nova.path')."/resources/productos/new?q=";

            $query = base64_encode(json_encode([
                request()->q
            ]));

            return response()->json([
                'url' => $baseUrl . $query,
            ]);
        }
    }
}
