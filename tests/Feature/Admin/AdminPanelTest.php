<?php

namespace Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{

    use WithFaker;



    public function test_default_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create([
            'name' => $this->faker()->name,
            'email' => $this->faker()->email,
            'password' => $this->faker()->password,
            'role' => 'user'
        ]);
        $response = $this->actingAs($user)->
            get(route('admin.index'));

        $response->assertRedirect(route('forbidden'));
    }


}
