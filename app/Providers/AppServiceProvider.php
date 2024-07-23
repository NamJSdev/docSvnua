<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sử dụng view composer để gắn dữ liệu vào view cụ thể
        View::composer('client.layouts.wrapper', function ($view) {
            $view->with('datas', Category::all());
        });
        View::composer('client.components.post-lastest', function ($view) {
            $view->with('topPosts', $topPosts = Post::orderBy('view', 'desc')
                ->limit(8)
                ->get());
        });
    }
}