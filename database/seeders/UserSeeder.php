<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new User();
        $item->name = "Hoàng Xuân Thắng";
        $item->email = "thang@gmail.com";
        $item->password = Hash::make('123456');
        $item->address = 'Quảng Trị';
        $item->phone  = "0392292507";
        $item->image ='polo.png';
        $item->gender ='Nam';
        $item->birthday ='2003/11/25';
        $item->group_id ='1';
        $item->save();
    }
}
