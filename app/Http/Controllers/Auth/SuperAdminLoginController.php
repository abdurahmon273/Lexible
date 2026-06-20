<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SuperAdminLoginController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.settings');
        }

        return view('auth.login', [
            'superAdminEmail' => config('super_admin.email'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $expectedEmail = config('super_admin.email');
        $expectedPassword = config('super_admin.password');

        if ($credentials['email'] !== $expectedEmail || $credentials['password'] !== $expectedPassword) {
            return back()
                ->withErrors([
                    'email' => "Login yoki parol noto'g'ri.",
                ])
                ->onlyInput('email');
        }

        $user = User::query()->firstOrCreate(
            ['email' => $expectedEmail],
            [
                'name' => config('super_admin.name'),
                'password' => Hash::make($expectedPassword),
            ],
        );

        $user->forceFill([
            'name' => config('super_admin.name'),
            'password' => Hash::make($expectedPassword),
        ])->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.settings');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
