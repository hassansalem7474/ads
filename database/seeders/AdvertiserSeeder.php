<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdvertiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertiser::create([
            'name' => 'hassan',
            'email' => 'hassan@yahoo.com',
            'password' => Hash::make(12345678),
        ]);
        
        Advertiser::create([
            'name' => 'ahmed',
            'email' => 'ahmed@yahoo.com',
            'password' => Hash::make(12345678),
        ]);
    }
}