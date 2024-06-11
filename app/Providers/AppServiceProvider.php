<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Notifikasi;
use Illuminate\Support\ServiceProvider;
use App\Services\TelegramService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TelegramService::class, function ($app) {
            return new TelegramService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $user = auth()->user();

            if ($user) {
                // Mengecek peran pengguna
                if ($user->role === 'teknisi' || $user->role === 'admin') {
                    // Logika untuk teknisi
                    $notifikasiCount = Notifikasi::count();
                    $notifikasiTerbaru = Notifikasi::orderBy('created_at', 'desc')->take(5)->get();
                } else {
                    // Logika untuk klien
                    $notifikasiCount = Notifikasi::whereHas('devices', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->count();

                    $notifikasiTerbaru = Notifikasi::whereHas('devices', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->orderBy('created_at', 'desc')->take(5)->get();
                }

                // Menyuntikkan data ke view
                $view->with(compact('notifikasiCount', 'notifikasiTerbaru'));
            }
        });
    }
}
