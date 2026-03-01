<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Manager') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if (!$storageReady || !$permissionsReady)
                <div class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                    Database tables for user permissions are missing. Run: <code>php artisan migrate</code>
                </div>
            @endif

            <div class="um-card">
                <h3>Create User</h3>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="um-grid">
                        <div>
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="text" name="password" required>
                        </div>
                        <div class="um-check-row">
                            <input type="checkbox" id="create-admin" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
                            <label for="create-admin">Admin user</label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="um-title-small">Visible Logos</label>
                        <div class="um-apps">
                            @foreach ($apps as $app)
                                @if (!empty($app['id']))
                                    <label class="um-check-row">
                                        <input type="checkbox" name="permissions[]" value="{{ $app['id'] }}">
                                        <span>{{ $app['name'] }}</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="um-btn" @disabled(!$storageReady || !$permissionsReady)>Create User</button>
                </form>
            </div>

            <div class="um-card">
                <h3>Existing Users</h3>
                <div class="space-y-6">
                    @foreach ($users as $user)
                        @php
                            $selected = $user->dashboardApps->pluck('app_key')->all();
                        @endphp
                        <form method="POST" action="{{ route('users.update', $user) }}" class="um-user-box">
                            @csrf
                            @method('PUT')

                            <div class="um-grid">
                                <div>
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div>
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div>
                                    <label>New Password (optional)</label>
                                    <input type="text" name="password" value="">
                                </div>
                                <div class="um-check-row">
                                    <input type="checkbox" id="admin-{{ $user->id }}" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                                    <label for="admin-{{ $user->id }}">Admin user</label>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="um-title-small">Visible Logos</label>
                                <div class="um-apps">
                                    @foreach ($apps as $app)
                                        @if (!empty($app['id']))
                                            <label class="um-check-row">
                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $app['id'] }}"
                                                    {{ in_array($app['key'], $selected, true) ? 'checked' : '' }}
                                                >
                                                <span>{{ $app['name'] }}</span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="um-btn" @disabled(!$storageReady || !$permissionsReady)>Save User</button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .um-card {
            background: #fff;
            border: 1px solid #d9e2f6;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
        }
        .um-card h3 {
            margin: 0 0 14px;
            font-size: 22px;
            font-weight: 700;
            color: #1f355c;
        }
        .um-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
        @media (min-width: 900px) {
            .um-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        .um-grid label {
            display: block;
            margin-bottom: 6px;
            color: #425b85;
            font-size: 13px;
            font-weight: 600;
        }
        .um-grid input[type="text"],
        .um-grid input[type="email"] {
            width: 100%;
            border: 1px solid #cad7ef;
            border-radius: 10px;
            padding: 9px 10px;
            font-size: 14px;
        }
        .um-check-row {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .um-title-small {
            font-weight: 700;
            font-size: 14px;
            color: #1f355c;
        }
        .um-apps {
            margin-top: 8px;
            display: grid;
            gap: 8px 16px;
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
        @media (min-width: 900px) {
            .um-apps {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .um-user-box {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            background: #f8fbff;
        }
        .um-btn {
            margin-top: 14px;
            border: 0;
            border-radius: 10px;
            background: #1f3f82;
            color: #fff;
            padding: 10px 16px;
            font-weight: 700;
            cursor: pointer;
        }
        .um-btn[disabled] {
            opacity: .5;
            cursor: not-allowed;
        }
    </style>
</x-app-layout>
