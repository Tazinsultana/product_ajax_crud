<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(){
        $product = Product::latest()->paginate(5);
        // $product = Product::latest()->get();
        return view('product',compact('product'));
    }


// Add Product
public function AddProduct(Request $request){

    $request->validate(
        [
        'name'=> 'required|unique:products',
        'price'=> 'required',
        'quantity'=> 'required'

    ],
    [
        'name.required'=> 'Name is Required',
        'name.unique'=> 'Alreday exsits',
        'price.required'=> 'Price is Required',
        'quantity.required'=> 'Quantity is Required'

    ]
    );
    // dd($request->all());

// $product = new Product();
    // $product->name = $request->name;
    // $product->price = $request->price;
    // $product->quantity = $request->quantity;
    // $product->save();

    $name=$request->name;
    $price=$request->price;
    $quantity=$request->quantity;
    Product::create([
        'name'=>$name,
        'price'=>$price,
        'quantity'=>$quantity
        ]);

    return response()->json([

        'status'=> 'success',
    ]);


}

// Edit Product
public function EditProduct(Request $request){
    // dd($request->all());
    $product=Product::findOrFail($request->id);
    return response()->json([

       'status'=> 'success',
       'data'=>$product,
    ]);
// dd($request->all());
}

// UpdateProduct
public function UpdateProduct(Request $request){

    $request->validate(
        [
        'name'=> 'required|unique:products,name,' .$request->id,
        'price'=> 'required',
        'quantity'=> 'required'

    ],
    [
        'name.required'=> 'Name is Required',
        'name.unique'=> 'Alreday exsits',
        'price.required'=> 'Price is Required',
        'quantity.required'=> 'Quantity is Required'

    ]
    );
    $name=$request->name;
    $price=$request->price;
    $quantity=$request->quantity;
    Product::findOrFail($request->id)->update([
        'name'=>$name,
        'price'=>$price,
        'quantity'=>$quantity,


    ]);
    return response()->json([
        'status'=>'success',
    ]);



}


// Delete Product
public function DeleteProduct(Request $request){
    Product::find($request->id )->delete();
    return response()->json([
        'status'=> 'success'
    ]);

}
// Paginatate
public function Paginate(Request $request){

    $product = Product::latest()->paginate(5);
    return view('paginate',compact('product'))->render();

}
// Live Search

public function SearchProduct(Request $request){

    $product= Product::where('name','like','%'.$request->search.'%')
    ->orderBy('id','desc')
    ->paginate(5);
    if($product->count() >= 1){
        return view('paginate', compact('product'))->render();

    }
    else{
        return response()->json([
            'status'=>'Nothing Found'
        ]);
    }
}
}
