<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    public function findOne(string $id, Request $request)
    {
        $user = $request->user();
        if ($user->nameRole == 'admin') {
            $staff = User::find($id);
            $image = $staff->imageAccount()->first();
            $imageId = ($image == null ? -1 : $image->imageId);
            $staff['image'] = Image::where('imageId', '=', $imageId)->first();
            return $staff;
        }
        abort(403, 'You are not authorized');
    }
    public function findAll(Request $request)
    {
        $user = $request->user();
        if ($user->nameRole == 'admin') {
            $users = User::where('nameRole', 'staff')->get();
            foreach ($users as $key => $value) {
                $image = $users[$key]->imageAccount()->first();
                $imageId = ($image == null ? -1 : $image->imageId);
                $users[$key]['image'] = Image::where('imageId', '=', $imageId)->first();
            }
            return $users;
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
            'email' => 'required',
            'level' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'Exp' => 0,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'nameRole' => "staff",
            'password' => $request->password
        ]);

        $token = $staff->createToken('token-name', ['server:update'])->plainTextToken;

        return [
            "staff" => $staff,
            "token" => $token
        ];
    }

    public function update(string $id, Request $request)
    {
        if ($request->user()->nameRole != 'admin') {
            abort(403, 'You are not authorized');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'level' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
        ]);

        $staff = User::find($id);
        if (!$staff) {
            return ['message' => 'staff does not exist'];
        }

        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'Exp' => 0,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
        ]);

        return $staff;
    }

    public function delete(string $id, Request $request)
    {
        if ($request->user()->nameRole != 'admin') {
            abort(403, 'You are not authorized');
        }

        $staff = User::find($id);
        $image = $staff->imageAccount()->first();
        unlink(storage_path('app/' . $image->source));

        if (!$staff) {
            return ['message' => 'staff does not exist'];
        }
        $image->delete();
        $staff->delete();
        return $staff;
    }

}