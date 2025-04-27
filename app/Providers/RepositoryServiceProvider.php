<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Contracts\Repositories\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\PermissionRepository::class, \App\Repositories\Eloquent\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\DivisionRepository::class, \App\Repositories\Eloquent\DivisionRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ProjectTypeRepository::class, \App\Repositories\Eloquent\ProjectTypeRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\BugCauseRepository::class, \App\Repositories\Eloquent\BugCauseRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\BugDangerRepository::class, \App\Repositories\Eloquent\BugDangerRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ProjectRepository::class, \App\Repositories\Eloquent\ProjectRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ProjectStatusRepository::class, \App\Repositories\Eloquent\ProjectStatusRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\EmailRepository::class, \App\Repositories\Eloquent\EmailRepositoryEloquent::class);

        $this->app->bind(\App\Contracts\Repositories\ProjectBugCauseRepository::class, \App\Repositories\Eloquent\ProjectBugCauseRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ProjectBugDangerRepository::class, \App\Repositories\Eloquent\ProjectBugDangerRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\BugRateRepository::class, \App\Repositories\Eloquent\BugRateRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ProjectReportRepository::class, \App\Repositories\Eloquent\ProjectReportRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\WeeklyProjectReportRepository::class, \App\Repositories\Eloquent\WeeklyProjectReportRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\WeeklyReportCustomerBugRepository::class, \App\Repositories\Eloquent\WeeklyReportCustomerBugRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ReportRepository::class, \App\Repositories\Eloquent\ReportRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\CarrierRepository::class, \App\Repositories\Eloquent\CarrierRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\CarrierCleanConfigRepository::class, \App\Repositories\Eloquent\CarrierCleanConfigRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ActivityLogRepository::class, \App\Repositories\Eloquent\ActivityLogRepositoryEloquent::class);
        //:end-bindings:
    }
}
