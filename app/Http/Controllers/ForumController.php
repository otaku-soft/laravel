<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\forums_sections;
use App\Models\forums_categories;
use App\Models\forums_topics;
use App\Models\forums_posts;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(): View
    {
        $sections = forums_sections::all();
        return view('forum.index',["sections" => $sections]);
    }
    public function createForumSections(): Response
    {
        $truncate_sections = new forums_sections();
        $truncate_categories = new forums_categories();
        $truncate_topics = new forums_topics();
        $truncate_posts = new forums_posts();
        $truncate_sections::query()->truncate();
        $truncate_categories::query()->truncate();
        $truncate_topics::query()->truncate();
        $truncate_posts::query()->truncate();
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
                        "order" => 1,
                        "topics" =>
                        [
                            [
                                "subject" => "Persona 5",
                                "message" => "Best jrpg ever",
                                "user_id" => 1,
                            ],
                            [
                                "subject" => "Dragon quest  11",
                                "message" => "it is kinda overrated honestly",
                                "user_id" => 1
                            ],
                        ]
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
                if (isset($category['topics']))
                    foreach ($category['topics'] as $topic)
                    {
                        $entity_topic = new forums_topics();
                        $entity_topic->category_id = $entity_category->id;
                        $entity_topic->user_id = $topic['user_id'];
                        $entity_topic->subject = $topic['subject'];
                        $entity_topic->save();
                        $entity_post = new forums_posts();
                        $entity_post->message = $topic['message'];
                        $entity_post->user_id = $entity_topic->user_id;
                        $entity_post->topic_id = $entity_topic->id;
                        $entity_post->save();
                    }
            }
        }
        return new Response("data installed");
    }
    public function topicList(int $category_id ) : View
    {
        $category = forums_categories::find($category_id);
        $topics = $category->topics()->latest()->paginate(10);
        return view('forum.topicList',["category" => $category,'topics' => $topics]);
    }
    public function addTopic(int $categoryId, Request $request) : View
    {
        $category = forums_categories::find($categoryId);
        $request->session()->put("addTopicCategoryId",$categoryId);
        return view('forum.addTopic',["category" => $category]);
    }
    public function addTopicSaved(Request $request) : JsonResponse
    {
        try
        {
            $entity_topic = new forums_topics();
            $entity_topic->category_id = $request->session()->get("addTopicCategoryId");
            $entity_topic->user_id = Auth::id();
            $entity_topic->subject = $request->get("subject");
            $entity_topic->save();
            $entity_post = new forums_posts();
            $entity_post->user_id = Auth::id();
            $entity_post->topic_id = $entity_topic->id;
            $entity_post->message = $request->get("message");
            $entity_post->save();
        }
        catch (\Exception $e)
        {
            return new Response(["success" => false,500]);
        }
        return new JsonResponse(["success" => true]);
    }
    public function viewTopic($topic_id,Request $request) : view
    {
        $topic = forums_topics::find($topic_id);
        $posts = $topic->posts()->paginate(10);
        $request->session()->put("addTopicId",$topic->id);
        return view("forum.viewTopic",["topic" => $topic,"posts" => $posts]);
    }
    public function addPost(Request $request) : JsonResponse
    {
        try{
            $entity_post = new forums_posts();
            $entity_post->user_id = Auth::id();
            $entity_post->topic_id = $request->session()->get("addTopicId");
            $entity_post->message = $request->get("message");
            $entity_post->save();
            $topic = forums_topics::find($entity_post->topic_id);

        }
        catch (\Exception $e)
        {
            return new Response(["success" => false,500]);
        }
        //($topic->posts()->
        return new JsonResponse(["success" => true,"url" => route('forum_viewTopic',['topic_id' => $topic->id,'page' => $topic->posts()->paginate(10)->lastPage()])]);
    }
}
