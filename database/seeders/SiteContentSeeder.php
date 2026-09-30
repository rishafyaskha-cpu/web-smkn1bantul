<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Ekstrakurikuler;
use App\Models\Gallery;
use App\Models\OrganisasiSiswa;
use App\Models\PpdbProgram;
use App\Models\PpdbStep;
use App\Models\ProgramKeahlian;
use App\Models\SiteStatistic;
use App\Models\TeachingFactory;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/site.json');

        $data = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        $this->seedEkstrakurikuler($data['ekstrakurikuler'] ?? []);
        $this->seedOrganisasiSiswa($data['organisasi_siswa'] ?? []);
        $this->seedTeachingFactory($data['teaching_factory'] ?? []);
        $this->seedStatistics($data['site_statistic'] ?? []);
        $this->seedPpdbSteps($data['ppdb_step'] ?? []);
        $this->seedPpdbPrograms($data['ppdb_program'] ?? []);
        $this->seedAchievements($data['achievement'] ?? []);
        $this->seedGallery($data['gallery'] ?? []);
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedEkstrakurikuler(array $items): void
    {
        $names = [];

        foreach ($items as $index => $item) {
            Ekstrakurikuler::updateOrCreate(
                ['name' => $item['name']],
                [
                    'image' => $item['image'] ? ltrim($item['image'], '/') : null,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );

            $names[] = $item['name'];
        }

        Ekstrakurikuler::whereNotIn('name', $names)->delete();
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedOrganisasiSiswa(array $items): void
    {
        foreach ($items as $index => $item) {
            OrganisasiSiswa::updateOrCreate(
                ['name' => $item['name']],
                [
                    'logo' => isset($item['logo']) ? ltrim($item['logo'], '/') : null,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedTeachingFactory(array $items): void
    {
        foreach ($items as $index => $item) {
            $program = ProgramKeahlian::where('slug', $item['program'] ?? '')->first();

            TeachingFactory::updateOrCreate(
                ['title' => $item['title']],
                [
                    'partner_name' => $item['partner'] ?? null,
                    'logo' => isset($item['logo']) ? ltrim($item['logo'], '/') : null,
                    'program_keahlian_id' => $program?->id,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedStatistics(array $items): void
    {
        foreach ($items as $index => $item) {
            SiteStatistic::updateOrCreate(
                ['label' => $item['label']],
                [
                    'value' => $item['value'],
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedPpdbSteps(array $items): void
    {
        foreach ($items as $index => $item) {
            PpdbStep::updateOrCreate(
                ['title' => $item['title']],
                [
                    'description' => $item['description'] ?? null,
                    'icon' => $item['icon'] ?? 'clipboard',
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedPpdbPrograms(array $items): void
    {
        foreach ($items as $index => $item) {
            $program = ProgramKeahlian::where('slug', $item['program'] ?? '')->first();

            PpdbProgram::updateOrCreate(
                ['title' => $item['title']],
                [
                    'category' => $item['category'],
                    'description' => $item['description'] ?? null,
                    'program_keahlian_id' => $program?->id,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedAchievements(array $items): void
    {
        foreach ($items as $index => $item) {
            Achievement::updateOrCreate(
                ['title' => $item['title'], 'description' => $item['description']],
                [
                    'class_name' => $item['class_name'] ?? null,
                    'description' => $item['description'],
                    'image' => isset($item['image']) ? ltrim($item['image'], '/') : null,
                    'level' => $item['level'] ?? null,
                    'is_featured' => (bool) ($item['is_featured'] ?? false),
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * @param  array<string, array<int, array<string, mixed>>>  $groups
     */
    private function seedGallery(array $groups): void
    {
        foreach ($groups as $group => $images) {
            $images = array_values($images);

            foreach ($images as $index => $image) {
                Gallery::updateOrCreate(
                    ['image' => ltrim($image['image'], '/'), 'group' => $group],
                    [
                        'alt' => $image['alt'] ?? null,
                        'is_published' => true,
                        'sort_order' => $index + 1,
                    ]
                );
            }

            Gallery::where('group', $group)
                ->whereNotIn('image', array_map(fn (array $image): string => ltrim($image['image'], '/'), $images))
                ->delete();
        }
    }
}
