<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required",
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
