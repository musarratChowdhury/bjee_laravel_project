<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewUserValidate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function users()
    {
        return view('admin.users', ['users' => User::paginate(10)]);
    }

    public function addNewUser()
    {
        return view('admin.addNewUser', ['roles' => Role::all()]);
    }

    public function manageUser($userid)
    {
        $user = User::find($userid);
        return view('admin.manageUser', ['user' => $user, 'roles' => Role::all(), 'userRoles' => $user->getRoleNames()->toarray()]);
    }

    public function manageUserPost(Request $request, $userid)
    {
        $user = User::find($userid);
        $user->name = $request->username;
        $user->email = $request->email;
         $user->view_password = $request->password;

        if ($request->password !== '') {
            $user->password = Hash::make($request->password);
        }

        $user->status = $request->status ?? 1;

        $userRoles = $user->getRoleNames()->toarray();
        $tempRoles = Role::all();

        $roles = [];

        foreach ($tempRoles as $tempRole) {
            $roles[] = $tempRole['name'];
        }

        if (is_array($request->userrole) && count($request->userrole) > 0) {
            foreach ($roles as $role) {

                if ($role !== 'superadmin') {

                    if (in_array($role, $request->userrole, true) === true) {

                        // ROLE is in the form filed
                        if (in_array($role, $userRoles, true) === true) {
                            // echo '<br> current : ' . $role;
                        } else {
                            // User does not have This role
                            // echo '<br> new : ' . $role;
                            $user->assignRole($role);
                        }
                    } else {
                        // ROLE is not the form filed
                        if (in_array($role, $userRoles, true) === true) {
                            // User have This role
                            // echo '<br> remove : ' . $role;
                            $user->removeRole($role);
                        }
                    }
                }
            }
        } else {
            foreach ($userRoles as $role) {
                // echo '<br> remove : ' . $role;
                $user->removeRole($role);
            }
        }

        $user->update();

        return redirect()->route('admin.users')->with(['success' => 'User profile updated.']);
    }

    public function saveNewUser(SaveNewUserValidate $request)
    {

        $msg = '';
        $newUser = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'view_password' => $request->password,
        ]);

        $msg .= 'User ' . $request->username . ' is added';

        $userRole = Role::findById($request->userrole)->name;

        if ($userRole != null) {
            $msg .= ' as ' . $userRole;
            $newUser->assignRole($userRole);
        }
        return redirect()->route('admin.users')->with(['success' => $msg]);
    }
}
