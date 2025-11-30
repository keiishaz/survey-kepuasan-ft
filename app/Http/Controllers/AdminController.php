<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::query();

        // Apply search filter if provided
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        $admins = $query->get();
        return view('Admin.TambahAdmin.manajemen-admin', compact('admins'));
    }

    public function create()
    {
        return view('Admin.TambahAdmin.tambah-admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('Admin.TambahAdmin.edit-admin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Regular profile update (for other admins)
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin,email,'.$id.',id_admin',
        ]);

        $admin->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui');
    }

    // Method to update own profile for logged in admin
    public function updateProfil(Request $request)
    {
        $admin = Auth::user(); // get the authenticated user

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin,email,'.$admin->id_admin.',id_admin',
        ]);

        $admin->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    // Method to update password for logged in admin
    public function updatePassword(Request $request)
    {
        $admin = Auth::user(); // get the authenticated user

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak benar.'])->withInput();
        }

        // Update password
        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui');
    }

    // Method to show edit profil page for logged in admin
    public function editProfil()
    {
        // Check which guard has the authenticated user
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
        } else {
            $admin = Auth::user(); // This will use the default guard ('web')
        }

        return view('Admin.ProfilSendiri.edit-profil', compact('admin'));
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}