<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::orderby('name')->get();
        $users = User::orderby('name')->get();

        $data = [
            'title' => 'Users',
            'users' => $users
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add User',
        ];

        return view('user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tolong isi namenya.',
            'username.uniqe' => 'Tolong isi username yang unik.',
            'username.required' => 'Tolong isi usernamenya.',
            'password.required' => 'Isi donk passwordnya',
            'role.required' => 'Isi donk rolenya',
        ]; 


        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'password' => 'required',
            'role' => 'required|string|in:user,admin'
        ], $messages);

        // Hash PasswordQ
        $data['password'] = Hash::make($data['password']);

        // dd($data);
        User::create($data);

        // // username atau password tidak ada
        Alert::success("Success", "Add data success");
        return redirect('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        
        $data = [
            'title' => 'User Detail',
            'user' => $user
        ];

        return view('user.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect('user')->with("errorMessage", 'User tidak dapat ditemukan');
        }
        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];

        return view('user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Tolong isi namenya.',
            'username.unique' => 'Tolong isi username yang unik.',
            'username.required' => 'Tolong isi usernamenya.',
            'role.required' => 'Isi donk rolenya',
        ]; 

        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'password' => 'nullable',
            'role' => 'required|string|in:user,admin'
        ], $messages);

        try {
            $user = User::find($id);

            if ($request->has('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                $data['password'] = $user->password;
            }

            $user->update($data);

            Alert::success("Success", "Edit data success");
            return redirect('user');
        } catch (\Throwable $th) {
            Alert::error("Failed", $th->getMessage());
            return redirect('user');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        try{
            $user = User::find($id);
            $user->delete();

            Alert::success("Success", "Delete data success");
            return redirect('user');
   
        } catch(\Throwable $th){
            Alert::error("Failed", $th->getMessage());
            return redirect('user');
        }
    }
}
