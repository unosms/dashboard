<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if (!$storageReady)
                <div class="mb-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                    Database table for settings is missing. Run: <code>php artisan migrate</code>
                </div>
            @endif

            <div class="settings-panel overflow-hidden shadow-sm sm:rounded-2xl p-6 sm:p-8">
                <h3 class="settings-title">Logo Access Settings</h3>
                <p class="settings-subtitle">Edit URL and credentials used by each dashboard logo.</p>

                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="settings-grid">
                        @foreach ($apps as $app)
                            <div class="settings-card">
                                <h4>{{ $app['name'] }}</h4>

                                <label for="url-{{ $app['key'] }}">URL</label>
                                <input
                                    id="url-{{ $app['key'] }}"
                                    type="text"
                                    name="apps[{{ $app['key'] }}][url]"
                                    value="{{ old('apps.' . $app['key'] . '.url', $app['url']) }}"
                                    placeholder="http://example.com"
                                />

                                <label for="username-{{ $app['key'] }}">Username</label>
                                <input
                                    id="username-{{ $app['key'] }}"
                                    type="text"
                                    name="apps[{{ $app['key'] }}][username]"
                                    value="{{ old('apps.' . $app['key'] . '.username', $app['username'] ?? '') }}"
                                    placeholder="Username"
                                />

                                <label for="password-{{ $app['key'] }}">Password</label>
                                <input
                                    id="password-{{ $app['key'] }}"
                                    type="text"
                                    name="apps[{{ $app['key'] }}][password]"
                                    value="{{ old('apps.' . $app['key'] . '.password', $app['password'] ?? '') }}"
                                    placeholder="Password"
                                />
                            </div>
                        @endforeach
                    </div>

                    @if ($errors->any())
                        <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            Please check the form data and try again.
                        </div>
                    @endif

                    <div class="mt-6">
                        <button type="submit" class="save-btn" @disabled(!$storageReady)>Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .settings-panel {
            background: linear-gradient(145deg, #edeaf8 0%, #e9edf9 48%, #ebe9f7 100%);
            border: 1px solid #dde3f3;
        }
        .settings-title {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            color: #1f355c;
            font-weight: 700;
        }
        .settings-subtitle {
            margin: 8px 0 20px;
            color: #4a5b79;
        }
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 16px;
        }
        @media (min-width: 768px) {
            .settings-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1280px) {
            .settings-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .settings-card {
            background: #fff;
            border: 1px solid #dce5f6;
            border-radius: 12px;
            padding: 14px;
        }
        .settings-card h4 {
            margin: 0 0 12px;
            color: #1f355c;
            font-size: 17px;
            font-weight: 700;
        }
        .settings-card label {
            display: block;
            margin: 0 0 6px;
            color: #425b85;
            font-size: 13px;
            font-weight: 600;
        }
        .settings-card input {
            width: 100%;
            border: 1px solid #cad7ef;
            border-radius: 10px;
            padding: 8px 10px;
            margin: 0 0 10px;
            font-size: 14px;
            color: #0f172a;
        }
        .settings-card input:focus {
            outline: 0;
            border-color: #4f78e1;
            box-shadow: 0 0 0 2px rgba(79, 120, 225, 0.15);
        }
        .save-btn {
            border: 0;
            border-radius: 10px;
            background: #1f3f82;
            color: #fff;
            padding: 10px 16px;
            font-weight: 700;
            cursor: pointer;
        }
        .save-btn[disabled] {
            opacity: .5;
            cursor: not-allowed;
        }
    </style>
</x-app-layout>

