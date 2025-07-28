<?php

namespace App\Repositories;

use App\Http\Requests\MainSettingRequest;
use App\Models\{Setting};
use App\Services\Contracts\MainSettingInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session};
use App\Models\Concerns\UploadMedia2;
use Illuminate\Support\Facades\Cache;
use App\DataTables\Dashboard\History\HistoryDataTable;

class MainSettingRepository implements MainSettingInterface
{
    use UploadMedia2;
    public function __construct(protected HistoryDataTable $historyDataTable)
    {
        $this->historyDataTable = $historyDataTable;
    }

    public function index() {
        $setting = Setting::with(['media'])->orderBy('created_at', 'DESC')->first();
        $logo = $setting->getMediaUrl('setting', $setting, null, 'media', 'logo');
        $favicon = $setting->getMediaUrl('setting', $setting, null, 'media', 'favicon');
        return view('dashboard.admin.settings.index', [
            'title' => 'General Main Settings',
            'setting' => $setting,
            'logo' => $logo,
            'favicon' => $favicon,
        ]);
    }

    public function save(MainSettingRequest $request) {
        try {
            $setting = Setting::firstOrNew([]);
            $setting->fill($request->only([
                'email',
                'name',
                'description',
                'phone',
                'address',
                'currency',
                'loyalty_points',
                'delivery_fees',
                'version'
            ]));
            $setting->save();
            if ($request->hasFile('logo'))
                $setting->updateSingleMedia('setting', $request->file('logo'), $setting, null, 'media', true, false, 'logo');
            if ($request->hasFile('favicon'))
                $setting->updateSingleMedia('setting', $request->file('favicon'), $setting, null, 'media', true, false, 'favicon');
            return redirect()->back()->with('success', 'تم تحديث الإعدادات بنجاح.');
            Cache::forget('settings');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }

    public function history(HistoryDataTable $historyDataTable)
    {
        return $historyDataTable->render('dashboard.admin.settings.history', ['pageTitle' => 'History']);
    }
}
