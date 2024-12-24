<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $methods = [
            [
                'name' => 'Gửi đồ ở Bưu điện',
                'image' => 'https://duhocsunny.edu.vn/wp-content/uploads/2021/07/dich-vu-gui-hang-tai-han-quoc-buu-dien-han-quoc.jpg',
            ],
            [
                'name' => 'Gửi đồ ở cửa hàng tiện lợi CU',
                'image' => 'https://duhocsunny.edu.vn/wp-content/uploads/2021/07/dich-vu-gui-hang-tai-han-quoc-cu-post.jpg',
            ],
            [
                'name' => 'Gửi đồ ở cửa hàng tiện lợi GS',
                'image' => 'https://duhocsunny.edu.vn/wp-content/uploads/2021/07/dich-vu-gui-hang-tai-han-quoc-gs-postbox.jpg',
            ], 
            [
                'name' => 'Gửi đồ qua dịch vụ 4000 KRW',
                'image' => 'https://duhocsunny.edu.vn/wp-content/uploads/2021/07/dich-vu-gui-hang-tai-han-quoc-4000-KRW.jpg',
            ]
        ];

        foreach ($methods as $method) {
            \App\Models\PaymentMethod::create($method);
        }
    }
}
