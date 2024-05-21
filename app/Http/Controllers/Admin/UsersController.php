<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(10);
        return view('admin.users.index',["users" => $users]);
    }
    public function editModal(Request $request): View
    {
        $user = User::find($request->get("id"));
        $roles = Role::all();
        return view('admin.users.edit-user-modal',["user" => $user,"roles" => $roles]);
    }
    public function edit(Request $request) : JsonResponse
    {
        $user = User::find($request->get("id"));
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->syncRoles([$request->get("role")]);
        $user->save();
        return new JsonResponse(["success" => true]);
    }
}
