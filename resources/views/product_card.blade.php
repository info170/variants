<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

    <p class="ml-1"><b>PRODUCT CARD</b></p>

    <div>Name: <b>{{ $product->name }}</b></div>
    <div>
        @if (count($variants)>0)
            Variants:
            @foreach ($variants as $variant)
                <li><b>{{ $variant->name }}</b>, остаток <b>{{ $variant->total }}</b>
            @endforeach
        @endif
    </div>
    <br><br>
    <form method="post" action="/product/{{ $product->id }}">
    {{method_field('DELETE')}}
    @csrf
    <button type="submit">Delete Product</button>
    </form>

    <br><hr><br>
    ADD OPERATION TO
    <form method="post" action="/operations">
    @csrf
    <div class="mb-3">
      <div><b>{{ $product->name }}</b>
      <input type="hidden" name="product" value="{{ $product->id }}">
        <br><br>
        Select variant:
        @foreach ($variants as $variant)
            <br><br>
            <div style="border:solid 1px #000; width:300px; padding: 10px;">
            <input type="radio" name="variant" required value="{{ $variant->id }}"><b>{{ $variant->name }}</b><br>

            History of operations:
            @foreach ($operations_history as $operation)
                @if ($operation->variant_id==$variant->id)
                    <br>{{ $operation->value }}
                @endif
            @endforeach
            </div>
        @endforeach

      <br><br>
      <div><input type="text" name="value" class="form-control" placeholder="Кол-во"></div><br>
      <div><button type="submit">Add</button></div>
    </div>
    </form>
    <br>
    <a href="/"><<< Back</a>

    </body>
</html>
