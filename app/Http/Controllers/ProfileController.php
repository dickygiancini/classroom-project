<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\EditNikRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }

    public function update_nik(EditNikRequest $request)
    {
        auth()->user()->update([
            'nik' => $request->nik
        ]);

        return redirect()->back()->with('success-nik', 'Berhasil merubah NIK.');
    }
}
