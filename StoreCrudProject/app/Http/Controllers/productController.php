<?php

namespace App\Http\Controllers;
use App\Models\products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class productController extends Controller
{
    //this method will show products page
    public function index(){
    $products = Products::orderBy('created_at','DESC')->get();
    return view('products.list', ['products' => $products]);

    }
    public function create(){
        return view('products.create');
    }

    public function store(Request $request){

        //validation
        $rules=[
            'name'=>'required|min:5',
            'sku'=>'required|min:3',
            'price'=>'required|numeric'
        
        ];

        //here we will append image in rules
        if($request->image != ""){
            $rule['image']='image';
        }

        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        //insert products in db
        $product = new Products(); // Attempt to create a new Product object

        if ($product === null) {
            // Debugging: Output a message if $product is null
            echo "Failed to create Product object";
        } else {
            // Set product properties
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->description = $request->description;
        
            // Save the product
            $product->save();
            
            if($request->image != "")
            {
            //here we will store image
            $image=$request->image;
            $ext= $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; //unique image name

            //save image in directory
            $image->move(public_path('uploads/products'), $imageName);
            
            //save image name in db
            $product->image=$imageName;
            $product->save();
            }

        }
        
        
        return redirect()->route('products.index')->with('success','Product added successfully');
    }

    public function edit($id){
        $product = Products::find($id);
        return view("products.edit",compact('product'));
    }

    public function update($id , Request $request){
        $product = Products::find($id);
         //validation
         $rules=[
            'name'=>'required|min:5',
            'sku'=>'required|min:3',
            'price'=>'required|numeric'
        
        ];

        //here we will append image in rules
        if($request->image != ""){
            $rule['image']='image';
        }

        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('products.edit' ,$product->id)->withInput()->withErrors($validator);
            
        }
            // here we will update product
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->description = $request->description;
        
            // Save the product
            $product->save();
            
            if($request->image != "")
            {
            //delete old image 
            File::delete(public_path('uploads/products/'. $product->image));
            //here we will store image
            $image=$request->image;
            $ext= $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; //unique image name

            //save image in directory
            $image->move(public_path('uploads/products'), $imageName);
            
            //save image name in db
            $product->image=$imageName;
            $product->save();
           
            
        }
        
        return redirect()->route('products.index')->with('success','Product Updated successfully');
        
    }
    public function delete($id){
        $product = Products::find($id);

         //delete old image 
         File::delete(public_path('uploads/products/'. $product->image));

         //delete
         $product->delete();

         return redirect()->route('products.index')->with('success','Product Deleted successfully');
    }

}
