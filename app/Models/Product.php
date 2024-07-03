<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    // [fill]を使う際は必要⬇︎
    protected $fillable = ['product_name', 'company_id', 'price', 'stock', 'comment', 'img_path'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // 【新規登録】
    public function registerProduct($data, $image_path)
    {

        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->text,
            'img_path' => $image_path,
        ]);
    }

    // 【更新処理】
    public function updateProduct($id, $request, $image_path)
    {

        $product = Product::find($id)->fill([
            'product_name' => $request->product_name,
            'company_id' => $request->company,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->text,
            'img_path'  => $image_path,
        ])
            ->save();
    }
}
