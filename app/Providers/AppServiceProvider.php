<?php

namespace App\Providers;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Download;
use App\Models\Ekstrakurikuler;
use App\Models\OrganisasiSiswa;
use App\Models\PpdbProgram;
use App\Models\PpdbStep;
use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use App\Models\SiteSetting;
use App\Models\SiteStatistic;
use App\Models\TeachingFactory;
use App\Support\SchoolKnowledgeBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SchoolKnowledgeBase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        foreach ($this->chatbotKnowledgeModels() as $model) {
            $model::saved(fn () => app(SchoolKnowledgeBase::class)->flush());
            $model::deleted(fn () => app(SchoolKnowledgeBase::class)->flush());
        }
    }

    /**
     * @return list<class-string<Model>>
     */
    private function chatbotKnowledgeModels(): array
    {
        return [
            Achievement::class,
            Article::class,
            Download::class,
            Ekstrakurikuler::class,
            OrganisasiSiswa::class,
            PpdbProgram::class,
            PpdbStep::class,
            ProgramKeahlian::class,
            SaranaPrasarana::class,
            SiteSetting::class,
            SiteStatistic::class,
            TeachingFactory::class,
        ];
    }
}
