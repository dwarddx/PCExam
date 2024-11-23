<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Menampilkan daftar anggota
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        return view('members.create');
    }

    // Menambah anggota baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members,email',
            'phone' => 'nullable|string|max:255',
        ]);
    
        Member::create($validated);
    
        return redirect()->route('members.index');
    }

    public function edit(Member $member)
    {
        // Mengarahkan ke view edit anggota dengan data anggota
        return view('members.edit', compact('member'));
    }

    // Mengupdate anggota
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members,email,' . $member->id,
            'phone' => 'nullable|string|max:255',
        ]);

        // Mengupdate data anggota
        $member->update($validated);

        // Redirect ke halaman daftar anggota dengan pesan sukses
        return redirect()->route('members.index')->with('success', 'Anggota berhasil diperbarui.');
    }

        // Menghapus anggota
        public function destroy(Member $member)
        {
            // Menghapus data anggota
            $member->delete();
    
            // Redirect ke halaman daftar anggota dengan pesan sukses
            return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus.');
        }
}
