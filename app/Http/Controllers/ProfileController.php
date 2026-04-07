<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Helpers\UploadController;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $helpers;

    public function __construct()
    {
        $this->helpers = new UploadController();
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password') && $request->password != null) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $location = 'assets/images/profiles/';

            if ($user->image && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $user->image = $this->helpers->imageUpload($image, $location);
        }

        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}