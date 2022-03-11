<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Article,Category,User};

class FrontendController extends Controller
{
    // article
    public function article()
    {
      $article = Article::where('status','Publish')->orderBy('created_at','desc')->get();

      return \response()->json([
        'data'  => $article
      ],200);
    }

    public function articleAPI()
    {
      $article = Article::where('status','Publish')->orderBy('created_at','desc')->limit(6)->get();

      return \response()->json([
        'data'  => $article
      ],200);
    }

    // Show Article
    public function showArticle($slug)
    {
      $article = Article::where('slug',$slug)->first();

      $more = Article::where('category_id',$article->category_id)->whereNotIn('slug', [$slug])->limit(4)->where('status','Publish')->get();

      if ($article || $more) {
        return \response()->json([
          'data'  => $article,
          'more'  => $more
        ],200);
      }

      return \response()->json([
        'message'  => 'Berita Tidak Ditemukan',
        'errors'   => 404
      ],404);

    }
}
