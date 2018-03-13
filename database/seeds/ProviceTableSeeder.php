<?php

use Illuminate\Database\Seeder;

class ProviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
        	[
                'Name'            => 'Tên công ty',
                'Address'         => 'Địa chỉ của công ty',
                'Phone'           => 'Số điện thoại của công ty',
                'Hotline'           => 'Số điện thoại của công ty',
                'Tax'               => 'Số điện thoại của công ty',
                'Email'           => 'Company@gmail.com',
                'Skype'           => 'Company@gmail.com',
                'Facebook'        => 'Company@gmail.com',
                'Google'          => 'Company@gmail.com',
                'Twitter'         => 'Company@gmail.com',
                'Viber'           => 'Company@gmail.com',
                'Zalo'            => 'Company@gmail.com',
                'Logo'            => 'Company@gmail.com',
                'Img'             => 'Company@gmail.com',
                'Map'             => 'Company@gmail.com',
                'Analytic'        => 'Company@gmail.com',
                'Chatbox'         => 'Company@gmail.com',
                'MetaTitle'       => 'Tiêu đề của website',
                'MetaDescription' => 'Mô tả về website',
                'MetaKeyword'     => 'Từ khóa của công ty'
            ]
        ]);
    }
}
