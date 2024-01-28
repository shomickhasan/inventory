<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(
       private CategoryRepository $categoryRepository
    )
    {
    }

    public function store(Request $request){
        $category = $this->categoryRepository->categoryCreate( $request);
    }
}
