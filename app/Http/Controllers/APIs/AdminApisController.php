<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminApisController extends Controller
{
     //registration function api
     public function registration(Request $request){
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        if($data->save()){
            return response()->json('Register Success.',201);
        }else{
            return response()->json('Something went wrong !',401);
        }
     }
    //login function api
    public function doLogin(Request $request){
        $checkAdmin = User::where('email',$request->email)->first();
        if($checkAdmin){//check account
            //credential check
            if(Hash::check($request->password,$checkAdmin->password)){
                Session::put('key',$checkAdmin->id);
                return response()->json(array('Login Status'=>'Success','id' => $checkAdmin->id,'name'=>$checkAdmin->name),200);
            }else{//false credentials
                return response()->json('Failed !',401);
            }
        }else{//no account
            return response()->json('Failed !',401);
        }
    }
    //product retrieve function api
    public function getData(Request $request){
        if(empty(Session::get('key'))){
            $products = Product::get();
            $productArr = [];
            foreach($products as $product){
                $productArr[] = array(
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => asset('/images'.$product->image),
                );
            }
            return response()->json($productArr,200);
        }else{
            return response()->json(Session::get('key_admin'),401);
        }
       
    }
    //update api function
    public function updateData(Request $request,$id){
        if(empty(Session::get('key_admin'))){
            $products = Product::where('id',$id)->update([
                'name' => $request->name,
                'price' => $request->price
            ]);
            return response()->json('updated !',200);
        }else{
            return response()->json('Failed !',401);
        }
       
    }
    //delete api function
    public function deleteData(Request $request,$id){
        if(empty(Session::get('key'))){
            $products = Product::where('id',$id)->delete();
            return response()->json('Delete Success',200);
        }else{
            return response()->json('Failed !',401);
        }
    }
    //search data api
    public function searchData(Request $request){
        if(empty(Session::get('key'))){
            $products = Product::where('name','LIKE','%'.$request->name.'%')->get();
            foreach($products as $product){
                $productArr[] = array(
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => asset('/images'.$product->image),
                );
            }
            return response()->json($productArr,200);
        }else{
            return response()->json('Failed !',401);
        }
    }
}
