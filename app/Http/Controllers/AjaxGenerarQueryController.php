<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AjaxGenerarQueryController extends Controller
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
            $incluir_q_arr  = !empty(request()->incluir_q) ? array_map('trim', explode(',', request()->incluir_q)) : [];
            $excluir_q_arr  = !empty(request()->excluir_q) ? array_map('trim', explode(',', request()->excluir_q)) : [];
            $query_by       = count(request()->query_by) ? implode(', ', request()->query_by) : '';

            return response()->json([
                'query' => Producto::generarQuery($incluir_q_arr, $excluir_q_arr, request()->filters_by, $query_by),
            ]);
        }
    }
}
