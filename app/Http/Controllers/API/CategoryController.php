<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
          'data'  => $category,
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
        'category'  => 'required|unique:categories|max:15',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 417);
      }

      $category = Category::create([
        'category'  => $request->category,
        'desc'      => $request->desc,
      ]);

      return response()->json([
        'data'  => $category,
        'message' => 'Category Created'
      ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::find($id);

      if ($category) {
        return response()->json([
          'data' => $category
        ],200);
      }

      return response()->json([
        'message' => 'Data not found !'
      ],404);

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
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'category'  => ['required', Rule::unique('categories')->ignore($request->id, 'id'),'Max:20'],
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 417);
      }

      $category = Category::findOrFail($id);
      $category->category  = $request->category;
      $category->desc      = $request->desc;
      $category->save();

      if ($category) {
        return response()->json([
          'data'  => $category,
          'message' => 'Category Updated'
        ],201);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json([
          'data' => $category,
          'message' => 'Category deleted'
        ],201);
    }
}
