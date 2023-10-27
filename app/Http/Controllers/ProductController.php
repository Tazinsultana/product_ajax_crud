<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function Index(){
        $page=0;
        $item=5;
    $product = Product::latest()->skip($page*$item)->take($item)->get();
    $item_count=Product::count();
    $total_page= (int)ceil($item_count/$item);
       return view('product',compact('product','total_page'));
    }

    // Pagination
    // public function Pagination(Request $request)
    // {

    //     $page=$request->page;
    //     $item=5;
    //     $product = Product::latest()->skip($page*$item)->take($item)->get();
    //     $product_count=Product::count();
    //     // dd($product_count);
    //     $total_page= (int)ceil($product_count/5);
    //     return response()->json([
    //         'data'=>$product,
    //         'total_page'=>$total_page
    //      ]);
    //     }

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
// public function Paginate(Request $request){

//     $product = Product::latest()->get();
//     return view('paginate',compact('product'))->render();

// }
// Live Search

public function SearchProduct(Request $request){
    $page=$request->page;
    $item=5;

    $product= Product::where('name','like','%'.$request->search.'%')
    ->orderBy('id','desc')->skip($page*$item)->take($item)->get();
    $product_count=Product::where('name','like','%'.$request->search.'%')->count();
    $total_page=(int)ceil($product_count/$item);
        return response()->json([

            'data'=>$product,
            'total_page'=>$total_page
        ]);

    // }
    // else{
    //     return response()->json([
    //         'status'=>'Nothing Found'
    //     ],502);
    // }
}
}
