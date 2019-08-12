<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use Illuminate\Support\Facades\DB;

trait MigrationsHelper
{
    /**
     * Get the migrations in /database/migrations.
     *
     * @return array Array of migration names, empty if no migrations are existing
     */
    public function getMigrations()
    {
        $migrations = glob(database_path('migrations/*.php'));

        return str_replace('.php', '', $migrations);
    }

    /**
     * Get the migrations that have already been ran.
     *
     * @return \Illuminate\Support\Collection List of migrations
     */
    public function getExecutedMigrations()
    {
        return DB::table('migrations')->get()->pluck('migration');
    }
}
