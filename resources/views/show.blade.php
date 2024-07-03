@extends('parent')

@section('content')

<div class="row">
    <div class="pull-right">
        <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
    </div>
</div>

<div class="card w-50 mt-2">
    <div class="card-header">商品詳細画面</div>
    <div class="card-body">

        <label for="inputName" class="col-form-label">ID</label>
        <div class="col">
            <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product->id }}</div>
        </div>

        <label for=" inputName" class="col-form-label">商品名</label>
        <div class="col">
            <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product->product_name }}</div>
        </div>

        <label for="inputName" class="col-form-label">価格</label>
        <div class="col">
            <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product->price }}</div>
        </div>

        <label for="inputName" class="col-form-label">在庫</label>
        <div class="col">
            <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product->stock }}</div>
        </div>

        <label for="inputName" class="col-form-label">メーカー名</label>
        <div class="col">
            <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product-> company ->company_name }}</div>
        </div>

        <label for="inputName" class="col-form-label">商品画像</label>
        <div class="col">
            <div class="col" style="padding: 6px ">
                <img src="{{ asset($product->img_path) }}" width="100px">
            </div>
        </div>

        <label for="inputName" class="col-form-label">コメント</label>
        <div class="col">
            <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product->comment }}</div>
        </div>

        <div class="pull-right mt-4">
            <a class="btn btn-primary w-100" href="{{ route('products.edit', ['id'=>$product->id]) }}">編集</a>
        </div>
    </div>
</div>

@endsection