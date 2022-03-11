<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Article};
use Validator;
use Auth;
use Str;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $article = Article::orderBy('created_at','desc')->get();

      return response()->json([
        'data'  => $article
      ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'title'         => 'required|unique:articles|Max:100',
        'body'          => 'required',
        'category_id'   => 'required|exists:categories,id|numeric|min:1',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }

      $article = Article::create([
        'title'       => $request->title,
        'slug'        => Str::slug($request->title),
        'category_id' => $request->category_id,
        'body'        => $request->body,
        'status'      => $request->status,
      ]);

      return response()->json([
        'message' => 'Article created',
        'data'    => $article
      ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $article = Article::where('slug',$slug)->first();
      return response()->json([
        'data'  => $article
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
      $validator = Validator::make($request->all(), [
        // 'title'         => 'required|unique:articles|Max:100',
        'body'          => 'required',
        'category_id'   => 'required|exists:categories,id|numeric|min:1',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }

      $article = Article::where('slug',$slug)->first();
      $article->title       = $request->title;
      $article->slug        = Str::slug($request->title);
      $article->category_id = $request->category_id;
      $article->body        = $request->body;
      $article->status      = $request->status;
      $article->save();

      return response()->json([
        'message' => 'Article created',
        'data'    => $article
      ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
