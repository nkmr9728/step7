@extends('parent')

@section('title', '商品新規登録画面')

@section('content')


<form action="{{ route('products.store')}}" method="POST" enctype='multipart/form-data'>
    @csrf
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
        </div>
    </div>
    <div class="card w-50 mt-2">
        <div class="card-header">商品新規登録画面</div>
        <div class="card-body">

            <div class="mb-2 mt-2">
                <div class="form-group">
                    <label for=" inputName" class="col-form-label">商品名</label>
                    <input type="text" name="product_name" class="form-control" placeholder="商品名" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
                    <span style="color: red;">
                        <p>{{ $errors->first('product_name') }}</p>
                    </span>
                    @endif
                </div>
            </div>

            <div class="mb-2 mt-2">
                <div class="form-group">
                    <label for="inputName" class="col-form-label">メーカー名</label>
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
            </div>

            <div class="mb-2 mt-2">
                <div class="form-group">
                    <label for="inputName" class="col-form-label">価格</label>
                    <input type="text" name="price" class="form-control" placeholder="価格" value="{{ old('price') }}">
                    @if($errors->has('price'))
                    <span style="color: red;">
                        <p>{{ $errors->first('price') }}</p>
                    </span>
                    @endif
                </div>
            </div>

            <div class="mb-2 mt-2">
                <div class="form-group">
                    <label for="inputName" class="col-form-label">在庫</label>
                    <input type="text" name="stock" class="form-control" placeholder="在庫" value="{{ old('stock') }}">
                    @if($errors->has('stock'))
                    <span style="color: red;">
                        <p>{{ $errors->first('stock') }}</p>
                    </span>
                    @endif
                </div>
            </div>

            <div class="mb-2 mt-2">
                <div class="form-group">
                    <label for="inputName" class="col-form-label">コメント</label>
                    <textarea name="text" class="form-control" placeholder="コメント" rows="3"></textarea>
                    @if($errors->has('comment'))
                    <span style="color: red;">
                        <p>{{ $errors->first('comment') }}</p>
                    </span>
                    @endif
                </div>
            </div>

            <div class="mb-2 mt-2">
                <div class="form-group">
                    <label for="inputName" class="col-form-label">商品画像</label><br>
                    <input type="file" name="image">
                </div>
            </div>

            <div class="mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100" onclick='return confirm("登録しますか？")'>登録</button>
            </div>
        </div>
    </div>
</form>

@endsection