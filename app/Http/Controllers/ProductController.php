<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $validator = Validator::make($request->all(),[
            "category_id"=>"required",
            "qty"=>"required",
            "price"=>"required"
        ]);
        if($validator->fails()){
            return response()->json([
                "message"=>"Validation is Error",
                "error"=>$request->all()
            ],400);
        }
        $result = product::create($request->all());
        return response()->json([
            "message"=>"INSERT SUCCESSFULLY!",
            "DATA"=>$result
        ]);
    }
    public function getProduct(){
        $product = product::all();
        return response()->json([
            "message"=>"Show All View",
            "data"=>$product 
        ]);
    }
    public function getproductID($id){
        $product = product::find($id);
        if($product){
            // one to one with table products
            // $category = category::find($product->category_id);
            // $product->category = $category;
            $sub_category = $product->getCategory;
            // $product->sub = $sub_category;
            return response()->json([
                "message"=>"Show View   ".$id,
                "data"=>$product 
            ]);
        }else{
            return response()->json([
                "message"=>"Product is Not Found...!   ".$id,
            ]);
        }
        
    }
    public function getCategory($id){
        $category = subcategory::find($id);
        $all_poduct = $category->getSubcategory;
        if($category){
            // one to one with table products
           
            return response()->json([
                "message"=>"Show View   ".$id,
                "data"=>$category 
            ]);
        }else{
            return response()->json([
                "message"=>"Product is Not Found...!   ".$id,
            ]);
        }
    }
    public function DeleteProduct($id){
        $product = product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                "message"=>"Delete Suucessfully  ".$id,
            ]);
        }else{
            return response()->json([
                "message"=>"Product is Not Found...!   ".$id,
            ]);
        }
    }
    public function UpdateProduct($id,Request $request){
        $product = product::find($id);
        if($product){
            $updated = $product->update($request->all());
            return response()->json([
                "message"=>"Update Suucessfully  ".$id,
                "data"=>$product
            ],200);
        }else{
            return response()->json([
                "message"=>"Product is Not Found...!   ".$id,
            ],422);
        }
    }
}
