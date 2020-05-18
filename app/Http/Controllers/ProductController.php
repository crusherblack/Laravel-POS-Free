<?php

namespace App\Http\Controllers;
//© 2020 Copyright: Tahu Coding
use File;
use App\Product;
use App\HistoryProduct;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
       
        $products = Product::when(request('search'), function($query){
                        return $query->where('name','like','%'.request('search').'%');
                    })
                    ->orderBy('created_at','desc')
                    ->paginate(8);
        return view('product.index', compact('products'));
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){       

        DB::beginTransaction();

        try{
            $id = $request->id;

            if($id){
                $this->validate($request, [
                    'name' => 'required|min:2|max:200',
                    'price' => 'required',
                    'description' => 'required', 
                ]);

                if($request->addQty){
                    $qty = $request->qty + $request->addQty;
                    if($qty < 0){
                        return redirect()->back()->with('errorQty','Quantity cant be lower than zero');
                    }
                }else{
                    $qty = $request->qty;
                }

                $product_id = Product::find($id);
                if($request->has('image')){
                    $gambar = $request->image;
                    $new_gambar = time().$gambar->getClientOriginalName();
                    Image::make($gambar->getRealPath())->resize(null, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/images/' . $new_gambar));

                    File::delete(public_path($product_id->image));
                    
                    $product = [
                        'name' => $request->name,
                        'price' => $request->price,     
                        'qty' => $qty,          
                        'image' => 'uploads/images/'.$new_gambar,
                        'description' => $request->description,
                    ];
                }
                else{
                    $product = [
                        'name' => $request->name,
                        'price' => $request->price,     
                        'qty' => $qty,                         
                        'description' => $request->description,
                    ];
                }
                $product_id->update($product);
                if($request->addQty){
                    HistoryProduct::create([
                        'product_id' => $product_id->id,
                        'user_id' => Auth::id(),
                        'qty' => $request->qty,
                        'qtyChange' => $request->addQty,
                        'tipe' => 'change product qty from admin'
                    ]);
                }
                
                $message = 'Data Berhasil di update';

                DB::commit();
                return redirect()->back()->with('success',$message);   
            }else{
                $this->validate($request, [
                    'name' => 'required|min:2|max:200',
                    'price' => 'required',
                    'qty' => 'required',
                    'image' => 'mimes:jpeg,jpg,png,gif|required|max:25000',
                    'description' => 'required', 
                ]);

                $gambar = $request->image;
                $new_gambar = time().$gambar->getClientOriginalName();

                $product = Product::create([
                        'name' => $request->name,
                        'price' => $request->price,     
                        'qty' => $request->qty,          
                        'image' => 'uploads/images/'.$new_gambar,
                        'description' => $request->description,
                        'user_id' => Auth::id()
                ]);        

                Image::make($gambar->getRealPath())->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/' . $new_gambar));

                HistoryProduct::create([
                    'product_id' => $product->id,
                    'user_id' => Auth::id(),
                    'qty' => $request->qty,
                    'qtyChange' => 0,
                    'tipe' => 'created product'
                ]);

                $message = 'Data Berhasil di simpan';

                DB::commit();
                return redirect()->route('products.index')->with('success',$message);   
            }            
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->route('products.create')->with('error',$e);
        }         
    }

    public function edit($id){
        
        $product = Product::find($id);
        $history = HistoryProduct::where('product_id',$id)->orderBy('created_at','desc')->get();
        return view('product.edit',compact('product','history'));
    }

    public function destroy(Request $request,$id){
        DB::beginTransaction();

        try{
        $product = Product::find($id);
        $product->delete();
        File::delete(public_path($product->image));       

        DB::commit();
        return redirect()->route('products.index')->with('success','Product berhasil dihapus');                             
        }
        catch(\Exeception $e){
            DB::rollback();      
            return redirect()->route('products.index')->with('error',$e);      
        }  

        
    }

    //© 2020 Copyright: Tahu Coding
}
