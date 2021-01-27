<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <p class="ml-1"><b>PRODUCTS LIST</b></p>

        @foreach ($products as $product)

        <div style="width:300px; padding: 5px;"><a href="/product/{{ $product->id }}">{{ $product->name }}</a></div>

        @endforeach

    <br><br>
    <div style="border:solid 2px grey;width:300px;padding:10px;">
        <b>ADD NEW PRODUCT</b>
        <form method="post" action="/products">
            @csrf
            <div class="mb-3">
              <input type="text" name="name" placeholder="New product name">
            </div>
            <div>
                Select variants:
                @foreach ($variants as $variant)
                    <br><input type="checkbox" name="variant[]" value="{{ $variant->id }}">{{ $variant->name }}
                @endforeach
            </div>
            <br>
            <button type="submit">Add Product</button>
        </form>
    </div>

    <br><br>
    <div style="border:solid 2px grey;width:300px;padding:10px;">
        <b>ADD NEW VARIANT</b>
        <form method="post" action="/variants">
            @csrf
            <input type="text" name="name" placeholder="New variant">
            <button type="submit">Add</button>
        </form>
    </div>





    </body>
</html>
