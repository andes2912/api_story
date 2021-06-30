<?php
namespace App\Repository;

use App\Repository\Contracts\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface {
  public function index(array $data)
  {
    try {

        $result = Category::all();

        return $result;

    } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage(), $e->getCode());
    }
  }
}