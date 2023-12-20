<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\ImageAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class RoleController extends Controller
{
    public function first(Request $request)
    {
        $arrRole = [];
        $arrRole[] = Role::create([
            'nameRole' => "admin",
            'description' => "admin have all permissions",
        ]);
        $arrRole[] = Role::create([
            'nameRole' => "user",
            'description' => "user have basic permissions",
        ]);
        $arrRole[] = Role::create([
            'nameRole' => 'staff',
            'description' => 'staff have permissions to manage staff',
        ]);

        $user = User::create([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => Hash::make("123456789"),
            'level'=> 0,
            'Exp' => 0,
            'phoneNumber' => "0343861387",
            'address' => "Vinh Long",
            'nameRole' => "user",
        ]);
        ImageAccount::create([
            "userId" => 1,
            "imageId" => 2
        ]);


        $staff = User::create([
            'name' => "staff",
            'email' => "staff@gmail.com",
            'password' => Hash::make("123456789"),
            'level'=> 0,
            'Exp' => 0,
            'phoneNumber' => "0343861388",
            'address' => "Vinh Long",
            'nameRole' => "staff",
        ]);
        ImageAccount::create([
            "userId" => 2,
            "imageId" => 2
        ]);

        $admin = User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("123456789"),
            'level'=> 0,
            'Exp' => 0,
            'phoneNumber' => "0343861387",
            'address' => "Vinh Long",
            'nameRole' => "admin",
        ]);
        ImageAccount::create([
            "userId" => 3,
            "imageId" => 2
        ]);

        event(new Registered($user));
        $tokenAdmin = $admin->createToken('token-name', ['server:update'])->plainTextToken;

        return [
            'arrRole' => $arrRole,
            'admin' => $admin,
            'staff' => $staff,
            'user' => $user,
            'tokenAdmin' => $tokenAdmin,
        ];
    }

    public function findAll(Request $request)
    {
        $user = $request->user();
        if ($user->nameRole == 'admin') {
            return Role::all();
        }
        abort(403, 'You are not authorized');
    }

    public function create(Request $request)
    {
        if ($request->user()->nameRole != 'admin') {
            abort(403, 'You are not authorized');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'dateExpire' => $request->dateExpire,
        ]);

        if (!$role) {
            abort(404, 'role already exists');
        }

        return "success";
    }

    public function update(String $id, Request $request) {
        if ($request->user()->nameRole != 'admin') {
            abort(403, 'You are not authorized');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::find($id);
        if (!$role) {
            abort(404, 'role does not exist');
        }

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'dateExpire' => $request->dateExpire,
        ]);


        return "success";
    }

    public function delete(string $id, Request $request)
    {
        if ($request->user()->nameRole != 'admin') {
            abort(403, 'You are not authorized');
        }
        $role = Role::find($id);
        if (!$role) {
            abort(404, 'role does not exist');
        }
        if ($role->nameRole == 'admin') {
            abort(403, 'role admin can not delete');
        }
        $role->delete();
        return "success";
    }
}
