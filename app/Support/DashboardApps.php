<?php

namespace App\Support;

use App\Models\DashboardApp;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DashboardApps
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function defaults(): array
    {
        return [
            ['key' => 'radius', 'name' => 'Radius', 'theme' => 'theme-radius', 'url' => 'http://89.43.132.141'],
            ['key' => 'olt', 'name' => 'OLT Manager', 'theme' => 'theme-olt', 'url' => 'http://89.43.132.136:11890'],
            ['key' => 'fiber-map', 'name' => 'Vertio Fiber Map', 'theme' => 'theme-map', 'url' => 'http://89.43.132.136:11880'],
            ['key' => 'middleware', 'name' => 'Middleware', 'theme' => 'theme-middleware', 'url' => 'http://89.43.132.136:62111'],
            ['key' => 'stock', 'name' => 'Stock Manager', 'theme' => 'theme-stock', 'url' => null],
            ['key' => 'iptv', 'name' => 'XTREAM IPTV', 'theme' => 'theme-iptv', 'url' => 'http://89.43.132.136:25500'],
            ['key' => 'twister', 'name' => 'TWISTER', 'theme' => 'theme-twister', 'url' => 'http://89.43.132.136:29180'],
            ['key' => 'voip', 'name' => 'VOIP', 'theme' => 'theme-voip', 'url' => 'http://89.43.132.135'],
            ['key' => 'netplay', 'name' => 'NETPLAY', 'theme' => 'theme-netplay', 'url' => 'http://89.43.132.134'],
            ['key' => 'crm', 'name' => 'CRM', 'theme' => 'theme-crm', 'url' => null],
            ['key' => 'storage', 'name' => 'STORAGE', 'theme' => 'theme-storage', 'url' => null],
            ['key' => 'log', 'name' => 'LOG Server', 'theme' => 'theme-log', 'url' => null],
            ['key' => 'astra', 'name' => 'Astra', 'theme' => 'theme-astra', 'url' => 'http://89.43.132.136:8000'],
            ['key' => 'tunner-1', 'name' => 'Tunner 1', 'theme' => 'theme-tunner-1', 'url' => 'http://89.43.132.136:680'],
            ['key' => 'tunner-2', 'name' => 'Tunner 2', 'theme' => 'theme-tunner-2', 'url' => 'http://89.43.132.136:681'],
            ['key' => 'vmware', 'name' => 'vmware', 'theme' => 'theme-vmware', 'url' => 'https://89.43.132.136:580'],
            ['key' => 'hls-decoder', 'name' => 'HLS Decoder', 'theme' => 'theme-hls-decoder', 'url' => 'http://89.43.132.136:28777'],
        ];
    }

    public static function storageReady(): bool
    {
        return Schema::hasTable('dashboard_apps');
    }

    public static function permissionsReady(): bool
    {
        return Schema::hasTable('dashboard_app_user');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(?User $user = null): array
    {
        $defaults = self::defaults();
        if (!self::storageReady()) {
            return array_map(static function (array $item): array {
                $item['id'] = null;
                $item['username'] = '';
                $item['password'] = '';
                return $item;
            }, $defaults);
        }

        self::ensureRecords();
        $stored = DashboardApp::query()->get()->keyBy('app_key');
        $allowedKeys = null;

        if ($user !== null && !$user->is_admin && self::permissionsReady()) {
            $allowedKeys = $user->dashboardApps()->pluck('dashboard_apps.app_key')->all();
        }

        $apps = array_map(static function (array $item) use ($stored): array {
            $record = $stored->get($item['key']);
            if ($record === null) {
                $item['id'] = null;
                $item['username'] = '';
                $item['password'] = '';
                return $item;
            }

            return [
                'id' => $record->id,
                'key' => $item['key'],
                'name' => $item['name'],
                'theme' => $item['theme'],
                'url' => $record->url,
                'username' => $record->username ?? '',
                'password' => $record->password ?? '',
            ];
        }, $defaults);

        if ($allowedKeys === null) {
            return $apps;
        }

        return array_values(array_filter($apps, static function (array $item) use ($allowedKeys): bool {
            return in_array($item['key'], $allowedKeys, true);
        }));
    }

    public static function ensureRecords(): void
    {
        if (!self::storageReady()) {
            return;
        }

        foreach (self::defaults() as $index => $item) {
            $app = DashboardApp::query()->firstOrCreate(
                ['app_key' => $item['key']],
                [
                    'name' => $item['name'],
                    'theme' => $item['theme'],
                    'url' => $item['url'],
                    'username' => null,
                    'password' => null,
                    'position' => $index + 1,
                ]
            );

            // Keep static metadata in sync without touching saved URL/credentials.
            $app->fill([
                'name' => $item['name'],
                'theme' => $item['theme'],
                'position' => $index + 1,
            ])->save();
        }
    }
}
