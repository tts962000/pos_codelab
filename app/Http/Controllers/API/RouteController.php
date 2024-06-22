<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products=Product::get();
        $user=User::get();
        $category=Category::get();
        $data=[
            'product'=>$products,
            'user'=>$user,
            'category'=>$category
        ];
        // return $data['product'][0]->name;
        return response()->json($data, 200);
    }

    //get all category list
    public function categoryList(){
        $category=Category::orderBy('id','desc')->get();
        return response()->json($category, 200);
    }

    //create category
    public function categoryCreate(Request $request){
        // dd($request->all());
        // dd($request->name);
        // dd($request->header('headerData'));
        $data=[
            'name'=>$request->name,  //db & postman
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];

        // return $data;

        $response=Category::create($data);
        return response()->json($response, 200);
    }

    //create contact
    public function createContact(Request $request){
        $data=$this->getContactData($request);
        // return $data;
        Contact::create($data);

        $contact=Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }

    //delete data
    public function deleteCategory($id){
        // return $request->all();
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
        return response()->json(['status'=>true,'message'=>'delete success','deleteData'=>$data], 200);
        }
        return response()->json(['status'=>false,'message'=>'There is no category'], 200);
    }

    //category details POST METHOD
    // public function categoryDetails(Request $request){
    //     $data=Category::where('id',$request->category_id)->first();
    //     if(isset($data)){
    //         Category::where('id',$request->category_id)->delete();
    //     return response()->json(['status'=>true,'category'=>$data], 200);
    //     }
    //     return response()->json(['status'=>false,'message'=>'There is no category'], 500);
    // }

    public function categoryDetails($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
           return response()->json(['status'=>true,'category'=>$data], 200);
        }
        return response()->json(['status'=>false,'message'=>'There is no category'], 500);
    }

    //update category
    public function categoryUpdate(Request $request){
        $categoryId=$request->category_id;
        $dbSource=Category::where('id',$categoryId)->first();

        if(isset($dbSource)){
            $data=$this->getCategoryData($request);
            Category::where('id',$categoryId)->update($data);
            $response=Category::where('id',$categoryId)->first();
            return response()->json(['status'=>true,'message'=>'category update success...','category'=>$response], 200);
        }
        return response()->json(['status'=>false,'message'=>'there is no category for update...'], 500);

        // return $data;
    }

    //get contact data
    private function getContactData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData($request){
        return[
            'name'=>$request->category_name, //database postman
            'updated_at'=>Carbon::now()
        ];
    }
}
