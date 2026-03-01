<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lightwave Dashboard') }}
        </h2>
    </x-slot>

    @php
        $apps = [
            ['key' => 'radius', 'name' => 'Radius', 'theme' => 'theme-radius'],
            ['key' => 'olt', 'name' => 'OLT Manager', 'theme' => 'theme-olt'],
            ['key' => 'fiber-map', 'name' => 'Vertio Fiber Map', 'theme' => 'theme-map'],
            ['key' => 'middleware', 'name' => 'Middleware', 'theme' => 'theme-middleware'],
            ['key' => 'stock', 'name' => 'Stock Manager', 'theme' => 'theme-stock'],
            ['key' => 'iptv', 'name' => 'XTREAM IPTV', 'theme' => 'theme-iptv'],
            ['key' => 'twister', 'name' => 'TWISTER', 'theme' => 'theme-twister'],
            ['key' => 'voip', 'name' => 'VOIP', 'theme' => 'theme-voip'],
            ['key' => 'netplay', 'name' => 'NETPLAY', 'theme' => 'theme-netplay'],
            ['key' => 'crm', 'name' => 'CRM', 'theme' => 'theme-crm'],
            ['key' => 'storage', 'name' => 'STORAGE', 'theme' => 'theme-storage'],
            ['key' => 'log', 'name' => 'LOG Server', 'theme' => 'theme-log'],
        ];
    @endphp

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lw-surface overflow-hidden shadow-sm sm:rounded-2xl p-6 sm:p-8">
                <div class="lw-grid">
                    @foreach ($apps as $app)
                        <button type="button" class="lw-tile">
                            <span class="lw-icon-box {{ $app['theme'] }}">
                                <svg class="lw-svg" viewBox="0 0 48 48" aria-hidden="true">
                                    @switch($app['key'])
                                        @case('radius')
                                            <circle class="i-p" cx="24" cy="24" r="14"/>
                                            <circle class="i-a" cx="24" cy="24" r="9"/>
                                            <circle class="i-af" cx="24" cy="24" r="3.5"/>
                                            @break

                                        @case('olt')
                                            <rect class="i-sf" x="12" y="8" width="24" height="32" rx="5"/>
                                            <rect class="i-p" x="14" y="10" width="20" height="28" rx="4"/>
                                            <line class="i-a" x1="18" y1="17" x2="30" y2="17"/>
                                            <line class="i-a" x1="18" y1="23" x2="30" y2="23"/>
                                            <line class="i-a" x1="18" y1="29" x2="24" y2="29"/>
                                            <circle class="i-af" cx="30" cy="29" r="2"/>
                                            @break

                                        @case('fiber-map')
                                            <path class="i-a" d="M10 34 L19 28 L30 31 L39 20"/>
                                            <circle class="i-af" cx="10" cy="34" r="2.2"/>
                                            <circle class="i-af" cx="19" cy="28" r="2.2"/>
                                            <circle class="i-af" cx="30" cy="31" r="2.2"/>
                                            <circle class="i-af" cx="39" cy="20" r="2.2"/>
                                            <path class="i-p" d="M24 9 C19.5 9 16 12.4 16 16.9 C16 22.1 24 31 24 31 C24 31 32 22.1 32 16.9 C32 12.4 28.5 9 24 9 Z"/>
                                            <circle class="i-pf" cx="24" cy="17" r="2.3"/>
                                            @break

                                        @case('middleware')
                                            <rect class="i-sf" x="8" y="11" width="12" height="9" rx="2"/>
                                            <rect class="i-sf" x="28" y="11" width="12" height="9" rx="2"/>
                                            <rect class="i-sf" x="18" y="28" width="12" height="9" rx="2"/>
                                            <rect class="i-p" x="8" y="11" width="12" height="9" rx="2"/>
                                            <rect class="i-p" x="28" y="11" width="12" height="9" rx="2"/>
                                            <rect class="i-p" x="18" y="28" width="12" height="9" rx="2"/>
                                            <path class="i-a" d="M20 15 L28 15 M14 20 L24 28 M34 20 L24 28"/>
                                            @break

                                        @case('stock')
                                            <rect class="i-sf" x="10" y="14" width="14" height="11" rx="2"/>
                                            <rect class="i-sf" x="24" y="18" width="14" height="11" rx="2"/>
                                            <rect class="i-p" x="10" y="14" width="14" height="11" rx="2"/>
                                            <rect class="i-p" x="24" y="18" width="14" height="11" rx="2"/>
                                            <path class="i-a" d="M14 32 L18 36 L24 30"/>
                                            <line class="i-a" x1="28" y1="33" x2="38" y2="33"/>
                                            <line class="i-a" x1="28" y1="36" x2="34" y2="36"/>
                                            @break

                                        @case('iptv')
                                            <rect class="i-p" x="8" y="12" width="32" height="22" rx="4"/>
                                            <path class="i-af" d="M21 18 L31 23 L21 28 Z"/>
                                            <path class="i-a" d="M14 10 C17 7.5 20 6.5 24 6.5 C28 6.5 31 7.5 34 10"/>
                                            <path class="i-a" d="M18 9 C20 7.8 22 7.2 24 7.2 C26 7.2 28 7.8 30 9"/>
                                            @break

                                        @case('twister')
                                            <path class="i-p" d="M9 24 C14 17 20 13 28 14 C33 14.7 37 17.3 40 21"/>
                                            <path class="i-a" d="M9 30 C14 23 20 19 28 20 C33 20.7 37 23.3 40 27"/>
                                            <path class="i-p" d="M11 36 C16 30 22 27 29 27 C34 27.5 37 29.6 39 32"/>
                                            @break

                                        @case('voip')
                                            <path class="i-p" d="M15 13 C13 15 12 17.5 12 20 C12 27.7 20.3 36 28 36 C30.5 36 33 35 35 33 L31 29 C30.3 28.3 29.2 28.2 28.3 28.7 L26 30 L18 22 L19.3 19.7 C19.8 18.8 19.7 17.7 19 17 Z"/>
                                            <path class="i-a" d="M28 13 C30.5 13.4 32.6 14.6 34 16.5"/>
                                            <path class="i-a" d="M28 8 C32 8.5 35.5 10.5 38 14"/>
                                            @break

                                        @case('netplay')
                                            <path class="i-p" d="M13 22 H35 C38.3 22 40 24.4 39 27.5 L37.8 31.2 C37.1 33.5 35.4 35 33 35 H15 C12.6 35 10.9 33.5 10.2 31.2 L9 27.5 C8 24.4 9.7 22 13 22 Z"/>
                                            <circle class="i-af" cx="19" cy="28.5" r="2"/>
                                            <circle class="i-af" cx="29" cy="28.5" r="2"/>
                                            <path class="i-a" d="M24 14 L24 19 M21.5 16.5 L26.5 16.5"/>
                                            <circle class="i-a" cx="24" cy="11" r="3"/>
                                            @break

                                        @case('crm')
                                            <circle class="i-pf" cx="18" cy="18" r="4"/>
                                            <circle class="i-af" cx="30" cy="17" r="3.5"/>
                                            <path class="i-p" d="M11 33 C11 28.6 14.6 25 19 25 H21 C25.4 25 29 28.6 29 33"/>
                                            <path class="i-a" d="M25 33 C25 29.9 27.5 27.4 30.6 27.4 H31.4 C34.5 27.4 37 29.9 37 33"/>
                                            @break

                                        @case('storage')
                                            <ellipse class="i-p" cx="24" cy="13" rx="11" ry="4.3"/>
                                            <path class="i-p" d="M13 13 V21 C13 23.4 17.9 25.3 24 25.3 C30.1 25.3 35 23.4 35 21 V13"/>
                                            <path class="i-p" d="M13 21 V29 C13 31.4 17.9 33.3 24 33.3 C30.1 33.3 35 31.4 35 29 V21"/>
                                            <path class="i-a" d="M18 19 H30 M18 27 H30"/>
                                            @break

                                        @case('log')
                                            <rect class="i-p" x="11" y="9" width="26" height="30" rx="3"/>
                                            <path class="i-a" d="M16 16 H32 M16 21 H29 M16 26 H32"/>
                                            <rect class="i-sf" x="16" y="30" width="16" height="6" rx="1.5"/>
                                            <path class="i-p" d="M18 33 H20 M22 33 H30"/>
                                            @break
                                    @endswitch
                                </svg>
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
        .lw-svg {
            width: 48px;
            height: 48px;
        }
        .lw-svg .i-p,
        .lw-svg .i-a {
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .lw-svg .i-p {
            stroke: var(--icon-primary);
            stroke-width: 2.1;
        }
        .lw-svg .i-a {
            stroke: var(--icon-accent);
            stroke-width: 2.1;
        }
        .lw-svg .i-pf {
            fill: var(--icon-primary);
        }
        .lw-svg .i-af {
            fill: var(--icon-accent);
        }
        .lw-svg .i-sf {
            fill: var(--icon-soft);
        }
        .theme-radius { --icon-primary: #1e64e8; --icon-accent: #30c4ff; --icon-soft: #e8f4ff; }
        .theme-olt { --icon-primary: #0a7fa0; --icon-accent: #24c8c8; --icon-soft: #e8fbfb; }
        .theme-map { --icon-primary: #1278bb; --icon-accent: #5dd4ff; --icon-soft: #e9f7ff; }
        .theme-middleware { --icon-primary: #7c3aed; --icon-accent: #a78bfa; --icon-soft: #f2edff; }
        .theme-stock { --icon-primary: #f97316; --icon-accent: #f43f5e; --icon-soft: #fff2e8; }
        .theme-iptv { --icon-primary: #0f766e; --icon-accent: #14b8a6; --icon-soft: #e9fffb; }
        .theme-twister { --icon-primary: #2563eb; --icon-accent: #7dd3fc; --icon-soft: #e9f2ff; }
        .theme-voip { --icon-primary: #0284c7; --icon-accent: #06b6d4; --icon-soft: #ebfbff; }
        .theme-netplay { --icon-primary: #4338ca; --icon-accent: #22c55e; --icon-soft: #eceeff; }
        .theme-crm { --icon-primary: #4f46e5; --icon-accent: #ec4899; --icon-soft: #f3eeff; }
        .theme-storage { --icon-primary: #0369a1; --icon-accent: #06b6d4; --icon-soft: #e9fbff; }
        .theme-log { --icon-primary: #1e3a8a; --icon-accent: #3b82f6; --icon-soft: #edf2ff; }
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
