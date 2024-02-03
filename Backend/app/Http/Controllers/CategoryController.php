<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Helper\Custome;

class CategoryController extends Controller
{


    public function index(Request $request){


        try{
            $categories = Category::all();
           $mapedData=  $categories->transform(function ($category){
                $image = $category->image;
                $encodedImage = Custome::ImageBase64Encoded($category->image);
                if($encodedImage !=null){
                    $category->img= $encodedImage;
                    return $category;
                }

            });

            if($mapedData){
                return response()->json([
                    "status"=>"success",
                    'data'=>$mapedData,
                ]);
            }
           else{
                return response()->json([
                    'status'=>'fails',
                    'message'=>'data not found',
                ]);
            }
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'fails',
                'message'=>$e->getMessage(),
            ]);
        }
    }
    public function store(CategoryRequest $request)
    {
        //dd($request->all());
        try {
            /*if($request->image){
                $base64Image = $request->image;
                list($type, $data) = explode(';', $base64Image);
                list(,$mimeType)= explode('/',$type);
                list(, $data)      = explode(',', $data);
                $imageData = base64_decode( $data);
                $fileName = 'image_'.md5(uniqid()).time().'.'.$mimeType;
                $path = public_path('image/'.$fileName);
                file_put_contents($path,$imageData);
                $category = Category::create([
                        'name' => $request->name,
                        'creator_id' => auth()->user()->id,
                        'image'=> $path,
                    ]);



            }*/
            if($request->image){
                $path = Custome::imageBase64Decode($request->image);
                if($path != null){
                    $category = Category::create([
                        'name' => $request->name,
                        'creator_id' => auth()->user()->id,
                        'image'=> $path,
                    ]);
                }
            }


            return response()->json([
                'status' => 'success',
                'message' => 'Category successfully created',
            ], 201);

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id){
        try{
            $category = Category::find($id);
            if($category){
                return response()->json([
                    'status'=>'success',
                    'data'=>$category,
                ]);
            }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message'=>'data not found',
                ]);
            }

        }catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
