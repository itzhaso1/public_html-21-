<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\{Setting, Category};
use Illuminate\Support\Facades\{View, Cache, Schema};
class AppServiceProvider extends ServiceProvider {
    public function register(): void {}

    public function boot(): void {
        if (Schema::hasTable('settings')) {
            $settings = Cache::remember('app_settings', 60 * 60, function () {
                return Setting::with('media')->latest()->first();
            });
            if ($settings && $settings->media->isNotEmpty()) {
                $logo = $settings->getMediaUrl('setting', $settings, null, 'media', 'logo');
                $favicon = $settings->getMediaUrl('setting', $settings, null, 'media', 'favicon');
                $categories = Category::with(['translations', 'media', 'children.translations'])
                ->whereNull('parent_id')
                ->where('status', 'active')
                ->get();
                View::share([
                    'settings' => $settings,
                    'logo' => $logo,
                    'favicon' => $favicon,
                    'categories' => $categories,
                ]);
            }
        }
    }
}
