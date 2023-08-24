<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin')->only(['method1', 'method2']); // Apply to method1 and method2
        $this->middleware('role:admin')->except(['']); // Apply to other methods except method1 and method2
    }
 

    public function index()
    {
        $users=User::all();
        return view('pages.users.index',['users'=>$users]);
    }

    public function create()
    {
        
        // return view('auth.register');
    }


    public function store(Request $request)
    {
        $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'teacher', 'student'])],
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        toastr()->success('user added successfully');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        // $user=User::find($id);
        // return view('users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::find($id);
        $emailRule = Rule::unique('users')->ignore($id);

        $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $emailRule],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'teacher', 'student'])],
        ]);
        // Remove all roles from the user
        $user->syncRoles([]); // Pass an empty array to remove all roles

        // Assign the desired roles
        $user->assignRole($request->role);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        toastr()->success('user updated successfully');
        return redirect()->route('users.index')->with('success','user updated successfully');
    }

    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','user deleted successfully');
    }
}
