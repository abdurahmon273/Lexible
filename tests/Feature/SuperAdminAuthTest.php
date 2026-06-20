<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperAdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_home_redirects_to_login_without_loop(): void
    {
        $this->get('/')->assertRedirect(route('login'));
        $this->get('/login')->assertOk();
    }

    public function test_authenticated_home_redirects_to_admin_settings(): void
    {
        $user = User::factory()->create([
            'email' => config('super_admin.email'),
        ]);

        $this->actingAs($user)
            ->get('/')
            ->assertRedirect(route('admin.settings'));
    }

    public function test_super_admin_can_log_in(): void
    {
        $response = $this->post('/login', [
            'email' => config('super_admin.email'),
            'password' => config('super_admin.password'),
        ]);

        $response->assertRedirect(route('admin.settings'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => config('super_admin.email'),
        ]);
    }

    public function test_invalid_login_is_rejected(): void
    {
        User::factory()->create();

        $response = $this->from('/login')->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
