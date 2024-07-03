@extends('parent')

@section('content')

<form action="{{ route('products.update', ['id'=>$product->id])}}" method="POST" enctype='multipart/form-data'>
    @csrf
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('products.show', ['id'=>$product->id]) }}">戻る</a>
        </div>
    </div>
    <div class="card w-50 mt-2">
        <div class="card-header">商品編集画面</div>
        <div class="card-body">

            <label for="inputName" class="col-form-label">ID</label>
            <div class="col">
                <div class="col" style="background-color: #dcdcdc; padding: 6px ">{{ $product->id }}</div>
            </div>

            <label for="inputName" class="col-form-label">商品名</label>
            <div class="col">
                <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" placeholder="例）コカコーラ" required>
                @if($errors->has('product_name'))
                <span style="color: red;">
                    <p>{{ $errors->first('product_name') }}</p>
                </span>
                @endif
            </div>

            <label for="inputName" class="col-form-label">価格</label>
            <div class="col">
                <input type="text" name="price" value="{{ $product->price }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" placeholder="例）100" required>
                @if($errors->has('price'))
                <span style="color: red;">
                    <p>{{ $errors->first('price') }}</p>
                </span>
                @endif
            </div>

            <label for="inputName" class="col-form-label">在庫</label>
            <div class="col">
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" placeholder="例）20" required>
                @if($errors->has('stock'))
                <span style="color: red;">
                    <p>{{ $errors->first('stock') }}</p>
                </span>
                @endif
            </div>

            <label for="inputName" class="col-form-label">メーカー名</label>
            <div class="col">
                <select name="company" class="form-select">
                    <option value="" selected>メーカーを選択してください</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id}}">{{ $company ->company_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                <span style="color: red;">
                    <p>{{ $errors->first('company') }}</p>
                </span>
                @endif
            </div>

            <label for="inputName" class="col-form-label">商品画像</label><br>
            <input type="file" name="image"><br>

            <label for="inputName" class="col-form-label">コメント</label>
            <div class="col">
                <input type="text" name="text" value="{{ $product->comment }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" placeholder="コメント">
                @if($errors->has('text'))
                <span style="color: red;">
                    <p>{{ $errors->first('text') }}</p>
                </span>
                @endif
            </div>

            <div class="pull-right mt-4">
                <button type="submit" class="btn btn-primary w-100" onclick='return confirm("更新しますか？")'>更新</button>
            </div>
        </div>
    </div>
</form>

@endsection