<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'company_name' => 'コカ・コーラ',
                'street_address' => '東京都渋谷区渋谷4丁目6番3号',
                'representative_name' => 'ムラット・オズゲル',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => 'アサヒ',
                'street_address' => '東京都墨田区吾妻橋1丁目23番1号',
                'representative_name' => '米女 太一',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => 'キリン',
                'street_address' => '東京都中野区中野4丁目10番2号',
                'representative_name' => '南方 健志',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => 'サントリー',
                'street_address' => '大阪市北区堂島浜2丁目1番40号',
                'representative_name' => '新浪 剛史',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '伊藤園',
                'street_address' => '東京都渋谷区本町3丁目47番10号',
                'representative_name' => '本庄 大介',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
        ]);
    }
}
