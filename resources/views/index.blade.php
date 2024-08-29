@extends('parent')

@section('content')

<div class="row">
    <div class="col-md-4 col-lg-3  mb-4">
        <form class="card mb-4 search-form" action="{{route('products.index')}}" method="GET">
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
                <dt>価格帯</dt>
                <dd>
                    <div class="input-group">
                        <input type="text" name="min_price" class="form-control" placeholder="円" value="">
                        <span class="input-group-text">〜</span>
                        <input type="text" name="max_price" class="form-control" placeholder="円" value="">
                    </div>
                </dd>
                <dt>在庫数</dt>
                <dd>
                    <div class="input-group">
                        <input type="text" name="min_stock" class="form-control" placeholder="個" value="">
                        <span class="input-group-text">〜</span>
                        <input type="text" name="max_stock" class="form-control" placeholder="個" value="">
                    </div>
                </dd>
            </dl>
            <div class="card-footer">
                <button type="submit" class="btn w-100 btn-success" id="search-btn">検索</button>
            </div>
        </form>
    </div>

    <div class="col-md-8 col-lg-9">
        <div class="table-responsive" id="product-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>@sortablelink('id','ID')</th>
                        <th>商品画像</th>
                        <th>商品名</th>
                        <th>@sortablelink('price','価格')</th>
                        <th>@sortablelink('stock','在庫数')</th>
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
                                @method('DELETE')
                                <button data-product_id="{{$product->id}}" type="submit" class="btn btn-danger" id="btn-delete">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        buttonDelete();
        // 今回使うpreventDefaultとは「click」したときに本来発生するクッリクイベントを発生しないように抑制する機能である。
        $('#search-btn').on('click', function(e) {
            e.preventDefault();
            console.log("検索スタート");

            // serializeとはformタグの情報を一括取得
            let formValue = $('.search-form').serialize();

            $.ajax({
                    type: 'GET',
                    url: "{{ route('products.index') }}",
                    // コントローラーに情報を送りたいときはdataに送りたい情報をいれる。今回はformタグの一括情報をコントローラーに送りたいから、
                    // letでコントローラーに送りたい情報を定義する。
                    data: formValue,
                    // dataTypeは「json」でも「html」どちらでもできる。
                    dataType: 'html',
                })
                .done(function(data) {
                    console.log(data);
                    let newTable = $(data).find('#product-table');
                    $('#product-table').replaceWith(newTable);
                    // $('#product-table').html(newTable);
                    alert('ajax成功');
                    buttonDelete();
                })
                .fail(function() {
                    alert('エラー');
                });
        });
    });

    // 非同期処理の確認方法について
    // ブラウザの検証ツールで「ネットワーク」タブの中にある「Fetch/XHR」タグをクリックした状態で、実施したい非同期処理（今回なら、検索ボタンをクリックする）をする。
    // 実施後に検証ツール（画面右側）の下に１行項目が追加されれば、非同期処理ができている。また、PC上部にあるブラウザアイコンがぐるぐる読み込み状態になっていなければ大丈夫

    // 削除の非同期処理
    function buttonDelete() {
        $('.btn-danger').on('click', function(e) {
            e.preventDefault();
            var deleteConfirm = confirm('削除してよろしいでしょうか？');
            if (deleteConfirm == true) {
                var clickEle = $(this);
                var productID = clickEle.attr('data-product_id');


                $.ajax({
                        type: 'POST',
                        url: '/products/destroy/' + productID,
                        //userID にはレコードのIDが代入されています
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        },
                        data: {
                            'id': productID,
                            "_method": "DELETE"
                        },
                        dataType: 'json',
                    })
                    .done(function() {
                        // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
                        var deleteClick = clickEle.closest('tr');
                        deleteClick.hide();
                    })
                    .fail(function() {
                        alert('エラー');
                    });
            }

        })
    };
</script>

@endsection