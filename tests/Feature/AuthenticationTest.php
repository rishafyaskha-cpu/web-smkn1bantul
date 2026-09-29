<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_login_page_renders_for_guests(): void
    {
        $this->get(route('login'))->assertOk();
    }

    public function test_authenticated_user_is_redirected_away_from_login_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_valid_credentials_authenticate_the_user(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'rahasia123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_password_does_not_authenticate_the_user(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        $this->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'salah',
        ])->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_requires_email_and_password(): void
    {
        $this->post(route('login'), [])
            ->assertSessionHasErrors(['email', 'password']);

        $this->assertGuest();
    }

    public function test_login_is_throttled_after_repeated_failures(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        foreach (range(1, 6) as $attempt) {
            $this->post(route('login'), [
                'email' => $user->email,
                'password' => 'salah',
            ])->assertSessionHasErrors('email');
        }

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'salah',
        ])->assertTooManyRequests();
    }

    public function test_logout_ends_the_authenticated_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
