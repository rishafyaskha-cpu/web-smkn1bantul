<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guest_is_redirected_to_login_from_dashboard(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    }

    public function test_non_admin_user_is_forbidden_from_dashboard(): void
    {
        $user = User::factory()->nonAdmin()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_sees_dashboard_with_content_counts(): void
    {
        $user = User::factory()->create();
        Article::factory()->count(2)->create();
        Article::factory()->unpublished()->create();
        Achievement::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('3')
            ->assertSee('1');
    }

    public function test_admin_can_create_an_article(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.articles.store'), [
                'title' => 'Prestasi Baru Sekolah',
                'excerpt' => 'Ringkasan prestasi baru.',
                'body' => 'Isi lengkap prestasi baru sekolah.',
                'author' => 'Admin Sekolah',
                'published_at' => '2026-01-15 08:00:00',
                'is_published' => '1',
            ])
            ->assertRedirect(route('admin.articles.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('articles', [
            'title' => 'Prestasi Baru Sekolah',
            'slug' => 'prestasi-baru-sekolah',
            'is_published' => true,
        ]);
    }

    public function test_creating_an_article_requires_title_and_published_date(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.articles.create'))
            ->post(route('admin.articles.store'), [])
            ->assertSessionHasErrors(['title', 'published_at']);

        $this->assertDatabaseCount('articles', 0);
    }

    public function test_admin_can_update_an_article(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['title' => 'Judul Lama']);

        $this->actingAs($user)
            ->put(route('admin.articles.update', $article), [
                'title' => 'Judul Baru',
                'published_at' => '2026-02-01 09:30:00',
                'is_published' => '1',
            ])
            ->assertRedirect(route('admin.articles.index'));

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Judul Baru',
        ]);
    }

    public function test_admin_can_delete_an_article(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.articles.destroy', $article))
            ->assertRedirect(route('admin.articles.index'));

        $this->assertModelMissing($article);
    }

    public function test_non_admin_cannot_create_an_article(): void
    {
        $user = User::factory()->nonAdmin()->create();

        $this->actingAs($user)
            ->post(route('admin.articles.store'), [
                'title' => 'Percobaan',
                'published_at' => '2026-01-15 08:00:00',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('articles', 0);
    }

    public function test_admin_can_create_an_achievement(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.achievements.store'), [
                'title' => 'Juara 1 LKS',
                'student_name' => 'Budi Santoso',
                'class_name' => 'XII RPL 1',
                'description' => 'Juara 1 LKS tingkat provinsi.',
                'level' => 'Provinsi',
                'is_published' => '1',
                'is_featured' => '1',
            ])
            ->assertRedirect(route('admin.achievements.index'));

        $this->assertDatabaseHas('achievements', [
            'title' => 'Juara 1 LKS',
            'is_featured' => true,
        ]);
    }

    public function test_creating_an_achievement_requires_title_and_description(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.achievements.create'))
            ->post(route('admin.achievements.store'), [])
            ->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseCount('achievements', 0);
    }

    public function test_admin_can_delete_an_achievement(): void
    {
        $user = User::factory()->create();
        $achievement = Achievement::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.achievements.destroy', $achievement))
            ->assertRedirect(route('admin.achievements.index'));

        $this->assertModelMissing($achievement);
    }
}
