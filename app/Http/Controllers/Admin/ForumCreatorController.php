<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\forums_sections;
use App\Models\forums_categories;
use App\Models\Permission;

class ForumCreatorController extends Controller
{
    public function index(): View
    {
        $sections = forums_sections::all()->sortBy("order");
        return view('admin.forum-creator.index', ["sections" => $sections]);
    }

    public function reorderSections(Request $request): JsonResponse
    {
        $ids = $request->get("ids");
        $i = 0;
        foreach ($ids as $id) {
            $section = forums_sections::find($id);
            $section->order = $i;
            $section->save();
            $i++;
        }
        return new JsonResponse(["success" => true]);
    }

    public function addSection(Request $request): JsonResponse
    {
        $lastSection = forums_sections::orderBy("order", "desc")->first();
        $section = new forums_sections();
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->order = 0;
        if ($lastSection)
            $section->order = $lastSection->order + 1;
        $section->save();
        $permission = new Permission();
        $permission->name = 'section_'.$section->id;
        $permission->guard_name = 'web';
        $permission->save();
        return new JsonResponse(["success" => true]);
    }

    public function editModal(Request $request): View
    {
        $section = forums_sections::find($request->get("id"));
        return view('admin.forum-creator.edit-modal', ["section" => $section]);
    }

    public function editSection(Request $request): JsonResponse
    {
        $section = forums_sections::find($request->get("id"));
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->save();
        return new JsonResponse(["success" => true]);
    }

    public function deleteSectionModal(Request $request): View
    {
        $section = forums_sections::find($request->get("id"));
        return view('admin.forum-creator.delete-modal', ["section" => $section]);
    }

    public function deleteSection(Request $request): JsonResponse
    {
        $section = forums_sections::find($request->get("id"));
        if ($section) {
            $section->delete();
            return new JsonResponse(["success" => true]);
        }
        return new JsonResponse(["success" => false]);
    }

    public function categoryIndex($section_id): View
    {
        $section = forums_sections::find($section_id);
        return view('admin.forum-creator.category-index', ["section" => $section]);
    }

    public function orderCategories(Request $request): JsonResponse
    {
        $sectionParent = forums_sections::find($request->get("section_id"));
        $ids = $request->get("ids");
        $i = 0;
        foreach ($ids as $id) {
            $category = forums_categories::find($id);
            if ($sectionParent->id === $category->section_id) {
                $category->order = $i;
                $category->save();
                $i++;
            }
        }
        return new JsonResponse(["success" => false]);
    }

    public function addCategory(Request $request): JsonResponse
    {
        $section = forums_sections::find($request->get("section_id"));
        $lastCategory = $section->categories()->orderBy("order", "desc")->first();
        if ($section) {
            $category = new forums_categories();
            $category->section_id = $section->id;
            $category->name = $request->get("name");
            $category->description = $request->get("description");
            $category->order = 0;
            if ($lastCategory) {
                $category->order = $lastCategory->order + 1;
            }
            $category->save();
            $permission = new Permission();
            $permission->name = 'category_'.$category->id;
            $permission->guard_name = 'web';
            $permission->save();
        }
        return new JsonResponse(["success" => true]);
    }

    public function editCategoryModal(Request $request): View
    {
        $category = forums_categories::find($request->get("id"));
        return view('admin.forum-creator.edit-category-modal', ["category" => $category]);
    }

    public function editCategory(Request $request): JsonResponse
    {
        $section = forums_categories::find($request->get("id"));
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->save();
        return new JsonResponse(["success" => true]);
    }

    public function deleteCategoryModal(Request $request): View
    {
        $category = forums_categories::find($request->get("id"));
        return view('admin.forum-creator.delete-category-modal', ["category" => $category]);
    }
    public function deleteCategory(Request $request): JsonResponse
    {
        $category = forums_categories::find($request->get("id"));
        if ($category) {
            $category->delete();
            return new JsonResponse(["success" => true]);
        }
        return new JsonResponse(["success" => false]);
    }

}
