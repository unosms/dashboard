<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lightwave Dashboard') }}
        </h2>
    </x-slot>

    @php
        $apps = [
            ['name' => 'Radius', 'icon' => 'icon-1'],
            ['name' => 'OLT Manager', 'icon' => 'icon-2'],
            ['name' => 'Vertio Fiber Map', 'icon' => 'icon-3'],
            ['name' => 'Middleware', 'icon' => 'icon-4'],
            ['name' => 'Stock Manager', 'icon' => 'icon-5'],
            ['name' => 'XTREAM IPTV', 'icon' => 'icon-6'],
            ['name' => 'TWISTER', 'icon' => 'icon-7'],
            ['name' => 'VOIP', 'icon' => 'icon-8'],
            ['name' => 'NETPLAY', 'icon' => 'icon-9'],
            ['name' => 'CRM', 'icon' => 'icon-10'],
            ['name' => 'STORAGE', 'icon' => 'icon-11'],
            ['name' => 'LOG Server', 'icon' => 'icon-12'],
        ];
    @endphp

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lw-surface overflow-hidden shadow-sm sm:rounded-2xl p-6 sm:p-8">
                <div class="lw-grid">
                    @foreach ($apps as $app)
                        <button type="button" class="lw-tile">
                            <span class="lw-icon-box">
                                <span class="lw-icon {{ $app['icon'] }}"></span>
                            </span>
                            <span class="lw-label">{{ $app['name'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .lw-surface {
            background: linear-gradient(145deg, #edeaf8 0%, #e9edf9 48%, #ebe9f7 100%);
            border: 1px solid #dde3f3;
        }
        .lw-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }
        @media (min-width: 640px) {
            .lw-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .lw-grid {
                grid-template-columns: repeat(6, minmax(0, 1fr));
                gap: 24px;
            }
        }
        .lw-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: transparent;
            border: 0;
            cursor: pointer;
        }
        .lw-icon-box {
            width: 88px;
            height: 88px;
            border-radius: 10px;
            background: #fff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .18s ease;
        }
        .lw-tile:hover .lw-icon-box {
            transform: translateY(-3px);
        }
        .lw-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: inline-block;
            position: relative;
            background: linear-gradient(135deg, #27c5ee 0%, #315efb 100%);
        }
        .lw-icon::after {
            content: "";
            position: absolute;
            inset: 11px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.6);
        }
        .icon-2 { transform: rotate(8deg); }
        .icon-3 { transform: rotate(-10deg); }
        .icon-4 { border-radius: 4px; }
        .icon-5 { background: linear-gradient(135deg, #ff9f43 0%, #f368e0 100%); }
        .icon-6 { background: linear-gradient(135deg, #20bf6b 0%, #0fb9b1 100%); }
        .icon-7 { background: linear-gradient(135deg, #a55eea 0%, #45aaf2 100%); }
        .icon-8 { background: linear-gradient(135deg, #26de81 0%, #2bcbba 100%); }
        .icon-9 { background: linear-gradient(135deg, #fc5c65 0%, #fd9644 100%); }
        .icon-10 { background: linear-gradient(135deg, #4b7bec 0%, #8854d0 100%); }
        .icon-11 { background: linear-gradient(135deg, #3867d6 0%, #0fb9b1 100%); }
        .icon-12 { background: linear-gradient(135deg, #2d98da 0%, #1e3799 100%); }
        .lw-label {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #445066;
            text-align: center;
            line-height: 1.2;
            min-height: 38px;
            display: flex;
            align-items: center;
        }
    </style>
</x-app-layout>
