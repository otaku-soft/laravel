<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\forums_sections;
use App\Models\forums_categories;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        $sections = forums_sections::all();
        foreach ($sections as $section)
        {
            foreach ($section->categories()->orderBy("order")->get() as $category)
            {
                //echo $category->name."<br/>";
            }
        }
        return view('forum.index',["sections" => $sections]);
    }
    public function createForumSections(): Response
    {
        $truncate_sections = new forums_sections();
        $truncate_categories = new forums_categories();
        $truncate_sections::query()->truncate();
        $truncate_categories::query()->truncate();
        $sections =
        [
            [
                "name" => "Gaming",
                "description" => "Talk about gaming here!",
                "order"  => 1,
                "categories" =>
                [
                    [
                        "name" => "General",
                        "description" => "Talk about any type of game here",
                        "order" => 1
                    ],
                    [
                        "name" => "Jrpg",
                        "description" => "Talk about jrpgs here",
                        "order" => 2
                    ]
                ]
            ],
            [
                "name" => "Anime",
                "description" => "Talk about anime here",
                "order"  => 2,
                "categories" =>
                [
                    [
                        "name" => "General",
                        "description" => "Talk about any anime here",
                        "order" => 3
                    ],
                    [
                        "name" => "Waifus",
                        "description" => "Talk about your favorite waifus here",
                        "order" => 4
                    ]
                ]
            ]
        ];
        foreach ($sections as $section)
        {
            $entity_section = new forums_sections();
            $entity_section->name = $section['name'];
            $entity_section->description = $section['description'];
            $entity_section->order = $section['order'];
            $entity_section->save();
            foreach ($section['categories'] as $category)
            {
                $entity_category = new forums_categories();
                $entity_category->section_id = $entity_section->id;
                $entity_category->name = $category['name'];
                $entity_category->description = $category['description'];
                $entity_category->order = $category['order'];
                $entity_category->save();
            }
        }
        return new Response("data installed");
    }
}
