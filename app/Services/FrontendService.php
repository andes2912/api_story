<?php
namespace App\Services;

use App\Models\Article;
use App\Helpers\ClientResponderHelper;

class FrontendService {
    use ClientResponderHelper;

    // Get Article
    public function GetArticle()
    {
        try {
            $article = Article::where('status','Publish')->orderBy('created_at','desc')->paginate(10);
            return $this->responseSuccess($article,'Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    // Show Article
    public function ShowArticle($slug)
    {
        try {
            $article = Article::where('slug',$slug)->first();
            $more = Article::where('category_id',$article->category_id)->whereNotIn('slug', [$slug])->limit(4)->where('status','Publish')->get();
            $data = [
                'article'   => $article,
                'more'      => $more
            ];
            return $this->responseSuccess($data,'Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }

    }
}
