<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class homeController extends Controller
{
   public function home (){
    return view('main.home');
   }

  

 
}
