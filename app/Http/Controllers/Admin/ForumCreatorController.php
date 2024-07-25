<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ForumsSections;
use App\Models\ForumsCategories;
use App\Models\Permission;

class ForumCreatorController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $sections = ForumsSections::all()->sortBy("order");
        return view('admin.forum-creator.index', ["sections" => $sections]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reorderSections(Request $request): JsonResponse
    {
        $ids = $request->get("ids");
        $i = 0;
        foreach ($ids as $id)
        {
            $section = ForumsSections::find($id);
            $section->order = $i;
            $section->save();
            $i++;
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addSection(Request $request): JsonResponse
    {
        $lastSection = ForumsSections::orderBy("order", "desc")->first();
        $section = new ForumsSections();
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->order = 0;
        if ($lastSection)
            $section->order = $lastSection->order + 1;
        $section->save();
        return new JsonResponse(["success" => true]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function editModal(Request $request): View
    {
        $section = ForumsSections::find($request->get("id"));
        return view('admin.forum-creator.edit-modal', ["section" => $section]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function editSection(Request $request): JsonResponse
    {
        $section = ForumsSections::find($request->get("id"));
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->save();
        return new JsonResponse(["success" => true]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function deleteSectionModal(Request $request): View
    {
        $section = ForumsSections::find($request->get("id"));
        return view('admin.forum-creator.delete-modal', ["section" => $section]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteSection(Request $request): JsonResponse
    {
        $section = ForumsSections::find($request->get("id"));
        if ($section)
        {
            $section->delete();
            return new JsonResponse(["success" => true]);
        }
        return new JsonResponse(["success" => false]);
    }

    /**
     * @param $section_id
     * @return View
     */
    public function categoryIndex($section_id): View
    {
        $section = ForumsSections::find($section_id);
        return view('admin.forum-creator.category-index', ["section" => $section]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function orderCategories(Request $request): JsonResponse
    {
        $sectionParent = ForumsSections::find($request->get("section_id"));
        $ids = $request->get("ids");
        $i = 0;
        foreach ($ids as $id)
        {
            $category = ForumsCategories::find($id);
            if ($sectionParent->id === $category->section_id)
            {
                $category->order = $i;
                $category->save();
                $i++;
            }
        }
        return new JsonResponse(["success" => false]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addCategory(Request $request): JsonResponse
    {
        $section = ForumsSections::find($request->get("section_id"));
        $lastCategory = $section->categories()->orderBy("order", "desc")->first();
        if ($section)
        {
            $category = new ForumsCategories();
            $category->section_id = $section->id;
            $category->name = $request->get("name");
            $category->description = $request->get("description");
            $category->order = 0;
            if ($lastCategory)
            {
                $category->order = $lastCategory->order + 1;
            }
            $category->save();
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function editCategoryModal(Request $request): View
    {
        $category = ForumsCategories::find($request->get("id"));
        return view('admin.forum-creator.edit-category-modal', ["category" => $category]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function editCategory(Request $request): JsonResponse
    {
        $section = ForumsCategories::find($request->get("id"));
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->save();
        return new JsonResponse(["success" => true]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function deleteCategoryModal(Request $request): View
    {
        $category = ForumsCategories::find($request->get("id"));
        return view('admin.forum-creator.delete-category-modal', ["category" => $category]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteCategory(Request $request): JsonResponse
    {
        $category = ForumsCategories::find($request->get("id"));
        if ($category)
        {
            $category->delete();
            return new JsonResponse(["success" => true]);
        }
        return new JsonResponse(["success" => false]);
    }

}
