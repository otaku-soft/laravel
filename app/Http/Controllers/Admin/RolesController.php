<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Http\Controllers\Admin\Roles\Models\RoleSection;
use App\Models\forums_sections;
use App\Models\forums_categories;
use App\Models\Role;
use App\Models\Permission;
class RolesController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();
        return view('admin.roles.index',["roles" => $roles]);
    }
    public function addRole(Request $request): JsonResponse
    {
        if ($request->get("name") !== "admin")
        {
            $role = new Role();
            $role->name = $request->request->get("name");
            $role->guard_name = "web";
            $role->save();
        }
        return new JsonResponse(["success" => true]);
    }
    public function editRoleModal(Request $request)
    {
        $role = Role::find($request->get("id"));
        return view('admin.roles.edit-role-modal',["role" => $role]);
    }
    public function editRole(Request $request) : JsonResponse
    {
        $role = Role::find($request->get("id"));
        $role->name = $request->get("name");
        $role->save();
        return new JsonResponse(["success" => true]);
    }
    public function setForumPermissions(Request $request)
    {
        $role = Role::find($request->get("id"));
        $sections = forums_sections::all()->sortBy("order");
        return view('admin.roles.set-forum-permissions',["sections" => $sections,'role' => $role]);
    }
    public function setForumPermissionsSave(Request $request) : JsonResponse
    {
        $role = Role::find($request->get("id"));
        $existing_permissions = $role->getAllPermissions()->all();
        $section_ids = $request->get("sections");
        $category_ids = $request->get("categories");
        $new_permissions = [];
        foreach ($existing_permissions as $permission)
        {
            if (!(str_starts_with( $permission->name,"section_") || str_starts_with( $permission->name,"category_")))
            {
                $new_permissions[] = $permission->name;
            }
        }

        foreach ($section_ids as $section_id)
        {
            $new_permissions[] = "section_".$section_id;
        }
        foreach ($category_ids as $category_id)
        {
            $new_permissions[] = "category_".$category_id;
        }

        $role->syncPermissions($new_permissions);
        $role->save();
        return new JsonResponse(["success" => true]);
    }
}
