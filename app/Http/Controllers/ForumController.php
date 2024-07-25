<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ForumsSections;
use App\Models\ForumsCategories;
use App\Models\ForumsTopics;
use App\Models\ForumsPosts;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ForumController extends Controller
{
    const PAGINATE_LIMIT = 10;

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $sections = ForumsSections::orderBy("order")->get();
        return view('forum.index', ["sections" => $sections]);
    }

    /**
     * @param int $category_id
     * @return View
     */
    public function topicList(int $category_id): View
    {
        $this->checkForCategoryAccess($category_id);
        $category = ForumsCategories::find($category_id);
        $topics = $category->topics()->latest()->paginate(self::PAGINATE_LIMIT);
        return view('forum.topicList', ["category" => $category, 'topics' => $topics]);
    }

    /**
     * @param int $categoryId
     * @param Request $request
     * @return View
     */
    public function addTopic(int $categoryId, Request $request): View
    {
        $this->checkForCategoryAccess($categoryId);
        $category = ForumsCategories::find($categoryId);
        $request->session()->put("addTopicCategoryId", $categoryId);
        return view('forum.addTopic', ["category" => $category]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function addTopicSaved(Request $request)
    {
        try
        {
            $this->checkForCategoryAccess($request->session()->get("addTopicCategoryId"));
            $entity_topic = new ForumsTopics();
            $entity_topic->category_id = $request->session()->get("addTopicCategoryId");
            $entity_topic->user_id = Auth::id();
            $entity_topic->subject = $request->get("subject");
            $entity_topic->save();
            $entity_post = new ForumsPosts();
            $entity_post->user_id = Auth::id();
            $entity_post->topic_id = $entity_topic->id;
            $entity_post->message = $request->get("message");
            $entity_post->save();
        }
        catch (\Exception $e)
        {
            return new Response(["success" => false], 500);
        }
        return $this->redirectSuccessPostResponse($entity_topic);
    }

    /**
     * @param $topic_id
     * @param Request $request
     * @return View
     */
    public function viewTopic($topic_id, Request $request): view
    {
        $topic = ForumsTopics::find($topic_id);
        $this->checkForCategoryAccess($topic->category_id);
        $posts = $topic->posts()->paginate(self::PAGINATE_LIMIT);
        $request->session()->put("addTopicId", $topic->id);
        return view("forum.viewTopic", ["topic" => $topic, "posts" => $posts]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function addPost(Request $request)
    {
        try
        {
            $topic = ForumsTopics::find($request->session()->get("addTopicId"));
            $this->checkForCategoryAccess($topic->category_id);
            $entity_post = new ForumsPosts();
            $entity_post->user_id = Auth::id();
            $entity_post->topic_id = $request->session()->get("addTopicId");
            $entity_post->message = $request->get("message");
            $entity_post->save();
        }
        catch (\Exception $e)
        {
            return new Response(["success" => false], 500);
        }
        return $this->redirectSuccessPostResponse($topic);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function editMessage(Request $request)
    {
        try
        {
            $topic = ForumsTopics::find($request->session()->get("addTopicId"));
            $this->checkForCategoryAccess($topic->category_id);
            $lastPost = $topic->posts()->orderBy("id", "desc")->first();
            if ($lastPost->user->id !== Auth::id())
            {
                return new JsonResponse(["success" => false, 401]);
            }
            $lastPost->message = $request->get("message");
            $lastPost->save();
        }
        catch (\Exception $e)
        {
            return new JsonResponse(["success" => false], 500);
        }
        return $this->redirectSuccessPostResponse($topic);
    }

    /**
     * @param $category_id
     * @return void
     */
    function checkForCategoryAccess($category_id)
    {
        if (!$category_id || !Session::get("role")->hasPermissionTo("category_{$category_id}"))
        {
            abort(401);
        }
    }

    /**
     * @param ForumsTopics $topic
     * @return JsonResponse
     */
    private function redirectSuccessPostResponse(ForumsTopics $topic): JsonResponse
    {
        return new JsonResponse(["success" => true, "url" => route('forum_viewTopic', ['topic_id' => $topic->id, 'page' => $topic->posts()->paginate(self::PAGINATE_LIMIT)->lastPage()])]);
    }
}
