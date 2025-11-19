<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    public function index()  {
        $pembimbings = User::where('role', 'pembimbing')->get();
        return view('admin.pembimbing.index', compact('pembimbings'));
        
    }
     public function create()  {
        return view('admin.pembimbing.create');
        
     }
      public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pembimbing'

         ]);
         return redirect()->route('admin.pembimbing.index')->with('success', 'Pembimbing berhasil ditambahkan.');
      }
      public function edit (User $pembimbing)  {
        return view('admin.pembimbing.edit', compact('pembimbing'));
        
    }
    public function update(Request $request, User $pembimbing) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $pembimbing->id,
            'password' => 'nullable|min:8',

        ]);

         if ($request->filled('password')) {
            $pembimbing->password = Hash::make($request->password);
         }
          $pembimbing->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pembimbing->password,

          ]);

          return redirect()->route('admin.pembimbing.index')->with('success', 'Pembimbing berhasil di update');
    }
     public function destroy (User $pembimbing)  {
        if ($pembimbing->pembimbingSiswa()->count() > 0) {
            return redirect()->route('admin.pembimbing.index')->with('error', 'pembimbing tidak bisa dihapus karena masih memiliki siswa.');
        }
        $pembimbing->delete();
        return redirect()->route('admin.pembimbing.index')->with('success', 'Pembimbing berhasil dihapus.');

        
     }
     

}
