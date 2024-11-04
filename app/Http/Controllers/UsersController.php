<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::select('id', 'name', 'email')->get();

        // Return Inertia view with the users' data
        return Inertia::render('AdminDashboard', [
            'users' => $users,
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            // Redirect to the index with a success message
            return redirect()->route('users.index')->with('success', 'Data Berhasil Dihapus');
        }

        // Render the view with an error message if user not found
        return Inertia::render('AdminDashboard', [
            'users' => User::select('id', 'name', 'email')->get(),
            'error' => 'Data Tidak Ditemukan',
        ]);
    }

    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);
        if (!$user) {
            return Inertia::render('AdminDashboard', [
                'users' => User::select('id', 'name', 'email')->get(),
                'error' => 'Pengguna tidak ditemukan.',
            ]);
        }

        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        if ($validator->fails()) {
            return Inertia::render('AdminDashboard', [
                'users' => User::select('id', 'name', 'email')->get(),
                'error' => $validator->errors()->first(),
            ]);
        }

        // Update the user's information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('users.index')->with('success', 'Data Berhasil Diperbarui');
    }
}
