<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 商品画面一覧
    public function index(Request $rq)
    {
        //「キーワード検索」「メーカー名検索」
        $keyword = $rq->input('keyword');
        $company_id = $rq->input('company_id');
        $query = Product::query();

        if ($keyword) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }
        if ($company_id) {
            $query->where('company_id', '=', $company_id);
        }
        $companies_list = Company::all();
        $products = $query->get();

        return view('index', compact('products', 'companies_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  新規登録画面
    public function create()
    {
        $companies = Company::all();
        $products = Product::all();
        return view('create')
            ->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 新規登録処理
    public function store(ProductRequest $request)
    {
        // 画像処理
        $model = new Product();
        $image = $request->file('image');
        $image_path = null;
        if ($image) {
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images', $file_name);
            $image_path = 'storage/images/' . $file_name;
        };


        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->registerProduct($request, $image_path);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return back();
        }

        // 処理が完了したらにリダイレクト
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    // 詳細画面
    public function show($id)
    {
        $product = Product::find($id);

        return view('show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    // 編集画面
    public function edit($id)
    {
        $companies = Company::all();
        $product = Product::find($id);


        return view('edit', compact('product', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    //  更新処理
    public function update(ProductRequest $request, $id)
    {
        $model = new Product();
        $image = $request->file('image');
        $image_path = null;

        if ($image) {
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images', $file_name);
            $image_path = 'storage/images/' . $file_name;
        }
        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録処理呼び出し

            $product = new Product();
            $product->updateProduct($id, $request, $image_path);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return back();
        }

        // 処理が完了したらにリダイレクト
        return redirect(route('products.show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    // 削除処理
    public function destroy($id)
    {
        // $product = Product::find($id);
        // $product->delete();
        try {

            $product = Product::find($id);
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return back();
        }


        return redirect(route('products.index'));
    }
}
