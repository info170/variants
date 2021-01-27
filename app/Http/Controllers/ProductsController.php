<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Operation;
use DB;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $variants = Variant::all();

        return view('products',compact('products','variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $product = Product::create($request->only('name'));

        if ($request->input('variant'))
        {
            $product->variants()->attach($request->input('variant'));
        }

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        $operations_history = Operation::where('product_id',$id)->get();

        $variants = $product->variants;

        foreach ($variants as $varian)
        {
            $sum = DB::table('operations')->where('product_id',$id)
                                             ->where('variant_id',$varian->id)
                                             ->sum('value');
            $variants->find($varian->id)->total = $sum;
        }
        // return $variants;

        return view('product_card',compact('product','variants','operations_history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (request()->create_new_room) {
            //New Product will be created
            request()->validate([
                'room_name' => 'required|max:15'
            ]);

            $restaurant_id = session()->get('restaurant')->id;

            Product::create(array(
                        "restaurant_id" => $restaurant_id
                        ));

            $room = Product::latest()->first();

            $room->update(['name'=>request()->room_name]);
        } else {
            //Existing Product will be updated
            request()->validate([
                'room_name_change' => 'required|max:15'
            ]);

            $room->update(['name' => request()->room_name_change]);
        }

        return redirect('/room/'.$room->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        $product->delete();

        return redirect('/products');
    }


}
