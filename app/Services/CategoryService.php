<?php

namespace App\Services;

use Exception;
use ErrorException;
use App\Repository\CategoryRepository;

class CategoryService extends CategoryRepository {
  public function getList(array $data)
  {
      try {

          $result = $this->index($data);

          return $result;

      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }
  }
}