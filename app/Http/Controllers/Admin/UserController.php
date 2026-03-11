<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'The name field is required.',
            'email.unique' => 'This email is already registered.',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ];
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Password::defaults()];
        }
        $validated = $request->validate($rules, [
            'email.unique' => 'This email is already in use.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (! empty($validated['password'] ?? null)) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
