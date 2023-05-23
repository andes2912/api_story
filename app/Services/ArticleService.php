<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Str;
use App\Helpers\ClientResponderHelper;

class ArticleService {
    use ClientResponderHelper;

    public function ListArticle()
    {
        try {
            $article = Article::orderBy('created_at','desc')->get();
            return $this->responseSuccess($article,'Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    public function StoreArticle($params)
    {
        try {
            $article = Article::create([
                'title'       => $params->title,
                'slug'        => Str::slug($params->title),
                'category_id' => $params->category_id,
                'body'        => $params->body,
                'status'      => $params->status,
            ]);
            return $this->responseSuccess($article,'Create Articel Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    public function ShowArticle($slug)
    {
        try {
            $article = Article::where('slug',$slug)->first();
            return $this->responseSuccess($article,'Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    public function UpdateArticle($params, $slug)
    {
        try {
            $article = Article::where('slug',$slug)->first();
            $article->title       = $params->title;
            $article->category_id = $params->category_id;
            $article->body        = $params->body;
            $article->status      = $params->status;
            $article->update();
            return $this->responseSuccess($article,'Update Article Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }
}
