<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FrontendService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $frontendService;

    public function __construct(FrontendService $frontendService)
    {
        $this->frontendService = $frontendService;
    }

    public function GetArticleService()
    {
        return $this->frontendService->GetArticle();
    }

    // Show Article
    public function ShowArticleService($slug)
    {
        return $this->frontendService->ShowArticle($slug);
    }
}
