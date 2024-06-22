<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct pizza create page
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Delete Success!']);
    }

    //edit pizza
    public function edit($id){
        $pizza=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //update pizza page
    public function updatePage($id){
        $pizza=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data=$this->requestProductInfo($request);
        if($request->hasFile('pizzaImage')){
            $oldImageName=Product::where('id',$request->pizzaId)->first();
            $oldImageName=$oldImageName->image;

            if($oldImageName!=null){
                File::delete($oldImageName);
                // Storage::delete('public/'.$oldImageName);
            }
            $file=$request->file('pizzaImage');
            $fileName=uniqid().'_'.$file->getClientOriginalName();
            // $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            // $request->file('pizzaImage')->storeAs('public',$fileName);
            $file->move(public_path().'/image',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }
    //product create
    public function create(Request $request){
        // $file=$request->file('image');
        // $file_name=uniqid().'_'.$file->getClientOriginalName();
        // $file->move(public_path().'/images',$file_name);
        // $category=new Category();
        // $category->name=$request->name;
        // $category->tag_id=$request->tag_id;
        // $category->image=$file_name;
        $this->productValidationCheck($request,"create");
        $data=$this->requestProductInfo($request);
            $file=$request->file('pizzaImage');
            $file_name=uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/image',$file_name);

            // $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            // $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image']=$file_name;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //request product info
    private function requestProductInfo($request){
        return[
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,
            'image'=>$request->pizzaImage
        ];
    }
    //product validation check
    private function productValidationCheck($request,$action){
        $validationRules=[
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaWaitingTime'=>'required',
            'pizzaPrice'=>'required'
        ];
        $validationRules['pizzaImage']=$action=="create" ? 'required|mimes:jpg,jpeg,png,webp|file' : "mimes:jpg,jpeg,png,webp|file";
        Validator::make($request->all(),$validationRules)->validate();
    }
}
