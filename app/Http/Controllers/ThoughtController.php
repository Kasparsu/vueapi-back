<?php

namespace App\Http\Controllers;


use App\Services\RedditService;
use App\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function index()
    {
        $data = Thought::paginate(1);
        if ($data->isEmpty()) {
            return $this->fetchInfo(new RedditService());
        }
        return $data;
    }

    protected function fetchInfo(RedditService $redditService)
    {
        $array = $redditService->handle();
        foreach ($array as $item) {
            $object = $item->data;
            if (Thought::where('title', $object->title)->exists()) {
                if (!$object->stickied) {
                    Thought::create([
                        'title' => $object->title,
                        'link_url' => $object->url,
                        'score' => $object->score

                    ]);
                }
            }
        }
        return Thought::paginate(1);


    }
}
