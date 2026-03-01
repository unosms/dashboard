<?php

namespace App\Http\Controllers;

use App\Models\DashboardApp;
use App\Support\DashboardApps;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        return view('settings', [
            'apps' => DashboardApps::all(),
            'storageReady' => DashboardApps::storageReady(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        if (!DashboardApps::storageReady()) {
            return back()->with('error', 'Settings storage is not ready. Run migrations first.');
        }

        $validated = $request->validate([
            'apps' => ['required', 'array'],
            'apps.*.url' => ['nullable', 'string', 'max:2048'],
            'apps.*.username' => ['nullable', 'string', 'max:255'],
            'apps.*.password' => ['nullable', 'string', 'max:255'],
        ]);

        $appData = $validated['apps'];
        foreach (DashboardApps::defaults() as $index => $app) {
            $item = $appData[$app['key']] ?? [];
            $url = trim((string) ($item['url'] ?? ''));
            $username = trim((string) ($item['username'] ?? ''));
            $password = trim((string) ($item['password'] ?? ''));

            DashboardApp::query()->updateOrCreate(
                ['app_key' => $app['key']],
                [
                    'name' => $app['name'],
                    'theme' => $app['theme'],
                    'url' => $url !== '' ? $url : null,
                    'username' => $username !== '' ? $username : null,
                    'password' => $password !== '' ? $password : null,
                    'position' => $index + 1,
                ]
            );
        }

        return redirect()->route('settings.edit')->with('status', 'Settings updated successfully.');
    }
}

