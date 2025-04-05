<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_can_show_checkout_page_for_users_with_order(): void
    {
        $user = User::factory()->create([
            'name' => "Some name",
            'email' => 'example@gmail.com',
            'password' => '123454235342143324',
            'role' => 'user'
        ]);
        $paymentMethod = PaymentMethod::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'payment_method_id' => $paymentMethod->id
        ]);
        $response = $this->actingAs($user)
            ->get(route('orders.checkout', $order->id));

        $response->assertStatus(200);
    }

    public function test_cannot_show_checkout_page_for_users_with_no_order(): void
    {
        $user = User::factory()->create([
            'name' => "Some name",
            'email' => 'example@gmail.com',
            'password' => '123454235342143324123',
            'role' => 'user'
        ]);
        $user2 = User::factory()->create([
            'name' => "Some name2",
            'email' => 'example2@gmail.com',
            'password' => '123454235342143324',
            'role' => 'user'
        ]);
        $paymentMethod = PaymentMethod::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user2->id,
            'payment_method_id' => $paymentMethod->id
        ]);
        $response = $this->actingAs($user)
            ->get(route('orders.checkout', $order->id));

        $response->assertStatus(403);
    }

    public function test_cannot_show_checkout_page_for_users_with_finished_order(): void
    {
        $user = User::factory()->create([
            'name' => "Some name",
            'email' => 'example@gmail.com',
            'password' => '123454235342143324',
            'role' => 'user'
        ]);

        $paymentMethod = PaymentMethod::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'payment_method_id' => $paymentMethod->id,
            'finished_at' => Carbon::parse(now())->format('Y-m-d H:i:s'),
        ]);
        $response = $this->actingAs($user)
            ->get(route('orders.checkout', $order->id));

        $response->assertStatus(302);
    }

}
