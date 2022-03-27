<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            [
                'name' => '給与収入'
            ],
            [
                'name' => '事業収入'
            ],
            [
                'name' => '不動産収入'
            ],
            [
                'name' => '配当収入'
            ],
            [
                'name' => '年金収入'
            ],
            [
                'name' => '臨時収入'
            ],
            [
                'name' => 'その他収入'
            ],
            [
                'name' => '食費'
            ],
            [
                'name' => '消耗品費'
            ],
            [
                'name' => '趣味娯楽費'
            ],
            [
                'name' => '交際費'
            ],
            [
                'name' => '交通費'
            ],
            [
                'name' => '車両費'
            ],
            [
                'name' => '衣類費'
            ],
            [
                'name' => '医療費'
            ],
            [
                'name' => '学習費'
            ],
            [
                'name' => '通信費'
            ],
            [
                'name' => '水道高熱費'
            ],
            [
                'name' => '地代家賃'
            ],
            [
                'name' => '税金'
            ],
            [
                'name' => '保険料'
            ],
            [
                'name' => 'その他支出'
            ],
        ]);
    }
}
