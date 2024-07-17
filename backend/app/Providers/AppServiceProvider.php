<?php

namespace App\Providers;

use App\Models\Funil;
use App\Observers\FunilObserver;
use App\Repositories\ContatoEloquentORM;
use App\Repositories\ContatoRepositoryInterface;
use App\Repositories\EtapaEloquentORM;
use App\Repositories\EtapaRepositoryInterface;
use App\Repositories\FunilEloquentORM;
use App\Repositories\FunilRepositoryInterface;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FunilRepositoryInterface::class, FunilEloquentORM::class);
        $this->app->bind(EtapaRepositoryInterface::class, EtapaEloquentORM::class);
        $this->app->bind(ContatoRepositoryInterface::class, ContatoEloquentORM::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(static function ($notifiable, $token) {
            return 'http://localhost:8085/reset-password/'.$token;
         });

         Funil::observe(FunilObserver::class);
    }
}
