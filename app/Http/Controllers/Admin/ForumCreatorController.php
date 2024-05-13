<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\forums_sections;
use App\Models\forums_categories;
class ForumCreatorController extends Controller
{
    public function index() : View
    {
        $sections = forums_sections::all()->sortBy("order");
        return view('admin.forum-creator.index',["sections" => $sections]);
    }
    public function reorderSections(Request $request): JsonResponse
    {
        $ids = $request->get("ids");
        $i = 0;
        foreach($ids as $id)
        {
            $section = forums_sections::find($id);
            $section->order = $i;
            $section->save();
            $i++;
        }
        return new JsonResponse(["success" => true]);
    }
    public function addSection(Request $request) : JsonResponse
    {
        $lastSection = forums_sections::orderBy("order","desc")->first();
        $section = new forums_sections();
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->order = $lastSection->order+1;
        $section->save();
        return new JsonResponse(["success" => true]);
    }
    public function editModal(Request $request) : View
    {
        $section = forums_sections::find($request->get("id"));
        return view('admin.forum-creator.edit-modal',["section" => $section]);
    }
    public function editSection(Request $request): JsonResponse
    {
        $section = forums_sections::find($request->get("id"));
        $section->name = $request->get("name");
        $section->description = $request->get("description");
        $section->save();
        return new JsonResponse(["success" => true]);
    }
    public function deleteSectionModal(Request $request) : View
    {
        $section = forums_sections::find($request->get("id"));
        return view('admin.forum-creator.delete-modal',["section" => $section]);
    }
    public function deleteSection(Request $request) : JsonResponse
    {
        $section = forums_sections::find($request->get("id"));
        if ($section)
        {
            $section->delete();
            return new JsonResponse(["success" => true]);
        }
        return new JsonResponse(["success" => false]);
    }
}
