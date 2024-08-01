@extends('parent')

@section('content')

<!--  複数検索機能を挿入予定-->
<div class="row">
    <div class="col-md-4 col-lg-3  mb-4">
        <form class="card mb-4" action="{{route('products.index')}}" method="GET">
            <div class="card-header">商品検索</div>
            <style>
                .mb-4 {
                    margin-top: 25px;
                }
            </style>
            <dl class="search-box card-body mb-0">

                <dt>キーワード</dt>
                <dd>
                    <input type="text" name="keyword" class="form-control" placeholder="商品名" value="">
                </dd>

                <dt>メーカー名</dt>
                <dd>
                    <select name="company_id" class="form-select" id="company_id">
                        <option value="">全て</option>
                        @foreach ($companies_list as $companies)
                        <option value="{{$companies->id}}">{{ $companies ->company_name }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <div class="card-footer">
                <button type="submit" class="btn w-100 btn-success">検索</button>
            </div>
        </form>
    </div>

    <div class="col-md-8 col-lg-9">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品画像</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                        <th colspan="2"><a class="btn btn-success" href="{{ route('products.create')}}">新規登録</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td style="text-align: right;">{{ $product->id }}</td>
                        <td><img src="{{ asset($product->img_path) }}" width="50px" height="60px"></td>
                        <td>{{ $product->product_name }}</td>
                        <td style="text-align: right;">{{ $product->price }}円</td>
                        <td style="text-align: right;">{{ $product->stock }}個</td>
                        <td>{{ $product-> company ->company_name }}</td>
                        <td><a class="btn btn-info" href="{{ route('products.show', ['id'=>$product->id]) }}">編集</a></td>
                        <td>
                            <form action="{{ route('products.destroy', ['id'=>$product->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？")'>削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection