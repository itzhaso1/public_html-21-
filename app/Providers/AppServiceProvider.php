<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Setting, Category};
use Illuminate\Support\Facades\{View, Cache, Schema};

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            $settings = Cache::remember('app_settings', 60 * 60, function () {
                return Setting::with('media')->latest()->first();
            });

            if (!$settings || $settings->media->isEmpty()) {
                return;
            }

            $logo = $settings->getMediaUrl('setting', $settings, null, 'media', 'logo');
            $favicon = $settings->getMediaUrl('setting', $settings, null, 'media', 'favicon');

            $categories = Cache::remember('app_categories', 60 * 30, function () {
                return Category::with(['translations', 'media', 'children.translations'])
                    ->whereNull('parent_id')
                    ->where('status', 'active')
                    ->get();
            });

            View::share([
                'settings' => $settings,
                'logo' => $logo,
                'favicon' => $favicon,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            // Prevent app from crashing if DB is not ready
        }
    }
}
