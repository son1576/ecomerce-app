<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();
        $vendor = new Vendor();
        $vendor->banner = 'uploads/banner.jpg';
        $vendor->phone = '1234567890';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'Dhaka, Bangladesh';
        $vendor->description = 'This is a description';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
