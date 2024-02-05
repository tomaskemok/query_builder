<?php

namespace App\Http\Controllers;

use App\Models\Palabra;
use App\Models\Sinonimo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AjaxGetSinonimosController extends Controller
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
            if ($sinonimos = Palabra::where('palabra', 'ilike', request()->palabra)->first()?->getSinonimosYPlurales()) {
                return response()->json([
                    'sinonimos' => $sinonimos,
                ]);
            }

            return response()->json([
                'sinonimos' => [request()->palabra . " " . Str::plural(request()->palabra)],
            ]);
        }
    }
}