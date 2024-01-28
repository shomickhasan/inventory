<?php

namespace App\Repository;
use App\Repository;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryRepository extends Repository
{
    public function model(){
        return CategoryModel::class;
    }
    public function categoryCreate(Request $request){
        $category = CategoryModel::createdata([
                'name'=>$request->name,
                'descreption'=> $request->descreption
        ]);
    }

}
