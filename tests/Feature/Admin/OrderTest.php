<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Database\Seeders\DefaultDataSeeder;
use Database\Seeders\OrderStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->admin = User::factory()->create([
            'name' => 'Test name',
            'email' => 'example@mail.com',
            'password' => 'password12321321321@',
            'role' => 'admin',
        ]);
        $this->seed(DefaultDataSeeder::class);
    }

    public function test_cannot_store_order_with_products_which_amount_greater_than_available()
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'title' => 'Some product title',
            'price' => 111,
            'instruction' => 'Some instruction...',
            'category_id' => $category->id,
            'count' => 500,
            'image' => 'image.png'
        ]);
        $orderFields = [
            'user_id' => $this->admin->id,
            'payment_method_id' => $paymentMethod->id,
            'products' => [
                0 => [
                    'id' => $product->id,
                    'amount' => 600
                ]
            ]
        ];
        $this->actingAs($this->admin)
            ->post(route('admin.users.orders.store', $this->admin->id), $orderFields);


        $this->assertEquals(OrderProducts::all()->count(), 0);

    }

    public function test_cannot_update_order_with_products_which_amount_greater_than_available()
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'title' => 'Some product title',
            'price' => 111,
            'instruction' => 'Some instruction...',
            'category_id' => $category->id,
            'count' => 500,
            'image' => 'image.png'
        ]);
        $order = Order::factory()->create([
            'user_id' => $this->admin->id,
            'payment_method_id' => $paymentMethod->id,

        ]);
        $order->products()->attach([$product->id => ['amount' => 400]]);
        $orderProductsFields = [
            'products' => [
                0 => [
                    'id' => $product->id,
                    'amount' => 600
                ]
            ]
        ];
        $this->actingAs($this->admin)
            ->put(route('admin.orders.update', $order->id), $orderProductsFields);

        $this->assertDatabaseMissing('order_products', [
            'product_id' => $product->id,
            'order_id' => $order->id,
            'amount' => 600
        ]);

    }
}
