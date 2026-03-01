<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\DashboardApps;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(): View
    {
        $apps = DashboardApps::all();
        $users = User::query()->with('dashboardApps:id,app_key')->orderBy('id')->get();

        return view('users.index', [
            'apps' => $apps,
            'users' => $users,
            'permissionsReady' => DashboardApps::permissionsReady(),
            'storageReady' => DashboardApps::storageReady(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!DashboardApps::storageReady() || !DashboardApps::permissionsReady()) {
            return back()->with('error', 'User permissions storage is not ready. Run migrations first.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'is_admin' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:dashboard_apps,id'],
        ]);

        $isAdmin = $request->boolean('is_admin');
        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $isAdmin,
        ]);

        if (!$isAdmin) {
            $user->dashboardApps()->sync($validated['permissions'] ?? []);
        }

        return redirect()->route('users.index')->with('status', 'User created successfully.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if (!DashboardApps::storageReady() || !DashboardApps::permissionsReady()) {
            return back()->with('error', 'User permissions storage is not ready. Run migrations first.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'is_admin' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:dashboard_apps,id'],
        ]);

        $isAdmin = $request->boolean('is_admin');
        if ($user->id === Auth::id() && !$isAdmin) {
            return back()->with('error', 'You cannot remove your own admin role.');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->is_admin = $isAdmin;
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        if ($isAdmin) {
            $user->dashboardApps()->sync([]);
        } else {
            $user->dashboardApps()->sync($validated['permissions'] ?? []);
        }

        return redirect()->route('users.index')->with('status', 'User updated successfully.');
    }
}

