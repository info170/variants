<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operation;
use DB;

class OperationsController extends Controller
{

    public function store(Request $request)
    {
        // dd($request->all());

        $value = $request->input('value') ?? 0;

        DB::table('operations')->insert([
            'value' => $value,
            'product_id' => $request->input('product'),
            'variant_id' => $request->input('variant')
        ]);

        return redirect('/product/'.$request->input('product').'/');
    }

}
