<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dengan role 'user' (alias karyawan)
        $employees = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user', // Hanya 'admin' atau 'user'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.employees.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->withErrors('Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}