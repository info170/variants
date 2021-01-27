<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;

class VariantsController extends Controller
{

    public function store(Request $request)
    {
        // dump($request->all());

        Variant::create(request(['name']));

        return redirect('/products');
    }

    public function destroy(Product $product)
    {

        $tables = $room->tables()->get();

        $room->delete();

        return redirect('/rooms');
    }

}
