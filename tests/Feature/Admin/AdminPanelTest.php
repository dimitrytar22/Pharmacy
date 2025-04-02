<?php

namespace Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{

    use WithFaker,RefreshDatabase;


    public function test_default_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create([
            'name' => 'Test name',
            'email' => "example@mail.com",
            'password' => "password12321321321@",
            'role' => 'user'
        ]);
        $response = $this->actingAs($user)->
            get(route('admin.index'));

        $response->assertRedirect(route('forbidden'));
    }


}
