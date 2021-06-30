<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtisanCallController extends Controller
{
    // Migrate
    public function migrate()
    {
      $migrate = \Artisan::call('migrate');

      return 'Migrate Success !';
    }
}
