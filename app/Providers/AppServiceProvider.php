<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LOGISTIC\MESSAGE\Message;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        // Compartir la variable $unreadMessages con la vista del sidebar
        View::composer('layouts.partials.sidebar_user', function ($view) {
            $userId = Auth::id();

            // Solo si el usuario está autenticado
            if ($userId) {
                // Contar los mensajes no leídos
                $unreadMessages = Message::where('receiver_id', $userId)
                                        ->where('read', false)
                                        ->count();

                // Pasar la variable a la vista
                $view->with('unreadMessages', $unreadMessages);
            }
        });
    }
}
