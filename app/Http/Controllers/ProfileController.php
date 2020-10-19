<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();


        if ($image = $request->file('photo')) {
            $photoable_type = 'App\User';
            $photoable_id = $user->id;
            $file_to_store = time() . '_' . $user->name . '_.' . $image->getClientOriginalExtension();

            unlink('images/' . $user->photo->filename);

            if ($user->photo->delete()) {
                if ($user->photo()->create(['filename' => $file_to_store, 'photoable_id' => $photoable_id, 'photoable_type' => $photoable_type,])) {
                    $image->move(public_path('images'), $file_to_store);
                }
            }

            return response()->json([
                'message' => "Your profile image successfuly uploaded",
                'uploaded_image' => "<img src='/images/$file_to_store' class='img-thumbnail img-fluid'>",
            ]);
        } else {
            $rules = [
                'name' => 'required|string|min:5|max:30',
                'email' => 'required|email',
                'password' => 'nullable|min:6|confirmed',
            ];

            $this->validate($request, $rules);

            if ($user->update($request->merge(['password' => Hash::make($request->get('password'))])->except([$request->get('password') ? '' : 'password']))) {
                session()->flash('updated', 'Your profile updated');
                return redirect('/profile');
            }
        }
    }
}
