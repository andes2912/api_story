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
      $article = Article::all();

      return response()->json([
        'data'  => $article
      ],200);
    }

    // Show Article
    public function showArticle($slug)
    {
      $article = Article::where('slug',$slug)->first();

      return response()->json([
        'data'  => $article
      ],200);
    }
}
