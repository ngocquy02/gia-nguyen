<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        	[
                'Fullname' =>   'Nguyen duc nga11',
                'Email'    =>   'nguyenducnga225@gmail.com',
                'Password' =>   bcrypt('123456a'),
                'Phone'    =>   '0972927818',
                'Skype'    =>   'nguyenducnga225@gmail.com',
                'Facebook' =>   'nguyenducnga225@gmail.com',
                'Google'   =>   'nguyenducnga225@gmail.com',
                'Sex'      =>   1, 
                'Img'      =>   'noimage.gif',
                'IsActive' =>   1,
                'Role'     =>   1,
        ]);
    }
}
