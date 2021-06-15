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
      $article = Article::select('id','title','slug','created_at','updated_at')->get();

      return \response()->json([
        'data'  => $article
      ],200);
    }

    // Show Article
    public function showArticle($slug)
    {
      $article = Article::where('slug',$slug)->first();

      $more = Article::where('category_id',$article->category_id)->limit(4)->get();

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
