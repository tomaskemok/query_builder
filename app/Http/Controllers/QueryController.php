<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('query-builder.create');
    }
}
