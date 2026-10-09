<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // 1. Buat User (1 admin + 5 user biasa)
        // ============================================
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $users = User::factory(5)->create();

        // ============================================
        // 2. Buat 10 Kategori
        // ============================================
        $categories = Category::factory(10)->create();

        // ============================================
        // 3. Buat 60 Produk (distribusi ke kategori)
        // ============================================
        $products = Product::factory(60)->create([
            'category_id' => fn() => $categories->random()->id,
        ]);

        // ============================================
        // 4. Buat Alamat untuk tiap user
        // ============================================
        $addresses = collect();
        foreach ($users as $user) {
            $addresses->push(Address::factory()->create([
                'user_id' => $user->id,
            ]));
        }

        // ============================================
        // 5. Buat 20 Order + OrderItem + Payment
        // ============================================
        $users->each(function ($user) use ($products, $addresses) {
            $order = Order::factory()->create([
                'user_id' => $user->id,
                'address_id' => $addresses->random()->id,
            ]);

            // 2-4 item per order
            $itemsCount = rand(2, 4);
            $totalAmount = 0;

            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                $qty = rand(1, 3);
                $subtotal = $product->price * $qty;
                $totalAmount += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                ]);
            }

            // Update total_amount di order
            $order->update(['total_amount' => $totalAmount]);

            // Payment untuk order ini
            Payment::factory()->create([
                'order_id' => $order->id,
            ]);
        });

        // ============================================
        // 6. Buat 50 Review random
        // ============================================
        Review::factory(50)->create([
            'user_id' => fn() => $users->random()->id,
            'product_id' => fn() => $products->random()->id,
        ]);

        $this->command->info('✅ Seed selesai!');
        $this->command->info('   - 1 admin + 5 user');
        $this->command->info('   - 10 kategori');
        $this->command->info('   - 60 produk');
        $this->command->info('   - 5 order (dengan items + payment)');
        $this->command->info('   - 50 review');
    }
}