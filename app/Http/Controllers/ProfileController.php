<?php

namespace App\Http\Controllers;

use App\Models\ProfileModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = UserModel::findOrFail(Auth::id());
        $breadcrumb = (object) [
            'title' => 'Data Profil',
            'list' => [
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Profil', 'url' => url('/profile')]
            ]
        ];
        $activeMenu = 'profile';
        return view('profile', compact('user'), [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     request()->validate([
    //         'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
    //         'nama'     => 'required|string|max:100',
    //         'old_password' => 'nullable|string',
    //         'password' => 'nullable|min:5',
    //     ]);
    //     $user = UserModel::find($id);
    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     if ($request->filled('old_password')) {
    //         if (Hash::check($request->old_password, $user->password)) {
    //             $user->update([
    //                 'password' => Hash::make($request->password)
    //             ]);
    //         } else {
    //             return back()
    //                 ->withErrors(['old_password' => __('Please enter the correct password')])
    //                 ->withInput();
    //         }
    //     }
    //     if (request()->hasFile('profile_image')) {
    //         if ($user->profile_image && file_exists(storage_path('app/public/photos/' . $user->profile_image))) {
    //             Storage::delete('app/public/photos/' . $user->profile_image);
    //         }
    //         $file = $request->file('profile_image');
    //         $fileName = $file->hashName() . '.' . $file->getClientOriginalExtension();
    //         $request->profile_image->move(storage_path('app/public/photos'), $fileName);
    //         $user->profile_image = $fileName;
    //     }
    //     $user->save();
    //     return back()->with('status', 'Profile berhasil diperbarui');
    // }

    public function update(Request $request, $id)
    {
        request()->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'old_password' => 'nullable|string',
            'password' => 'nullable|min:5',
        ]);

        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }

        if (request()->hasFile('profile_image')) {
            if ($user->profile_image && file_exists(storage_path('app/public/photos/' . $user->profile_image))) {
                Storage::delete('app/public/photos/' . $user->profile_image);
            }
            $file = $request->file('profile_image');
            $fileName = $file->hashName() . '.' . $file->getClientOriginalExtension();
            $request->profile_image->move(storage_path('app/public/photos'), $fileName);
            $user->profile_image = $fileName;
        }

        $user->save();
        return back()->with('status', 'Profil Diperbarui');
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = UserModel::find(Auth::id());

        if ($user->profile_image && file_exists(storage_path('app/public/photos/' . $user->profile_image))) {
            Storage::delete('app/public/photos/' . $user->profile_image);
        }

        $fileName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->storeAs('public/photos', $fileName);

        $user->profile_image = $fileName;
        $user->save();

        return response()->json(['success' => true, 'file_name' => $fileName]);
    }
}