<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\{Setting};
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
                View::share([
                    'settings' => $settings,
                    'logo' => $logo,
                    'favicon' => $favicon,
                ]);
            }
        }
    }
}
