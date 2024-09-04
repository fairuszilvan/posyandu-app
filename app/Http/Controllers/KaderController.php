<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class KaderController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
        }
        $kader = $query->get();
        return view('kader.index', compact('kader'));
    }
    public function Store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Redirect pengguna kembali ke halaman yang sesuai
        return redirect()->route('kader.index')->with('success', 'Data Sudah Disimpan');
    }
    public function destroy($id)
    {
        $User = User::findOrFail($id);

        $User->delete();

        return redirect()->route('kader.index')->with('success', 'User has been deleted successfully.');
    }
    public function edit($id)
    {
        $User = User::findOrFail($id);

        return view('kader.edit', compact('User'))->with('success', 'User has been Edited successfully.');
    }
    public function show($id)
    {
        $User = User::findOrFail($id);
        return view('kader.show');
    }
}
