<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;
use File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at','desc')->paginate(8);
        return view('product.index', compact('products'));
    }

    public function create(){
        return view('product.create', compact('products'));
    }

    public function store(Request $request){       

        DB::beginTransaction();

        try{
            $id = $request->id;

            if($id){
                $this->validate($request, [
                    'name' => 'required|min:2|max:200',
                    'price' => 'required',
                    'qty' => 'required',
                    'description' => 'required', 
                ]);

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
                        'qty' => $request->qty,          
                        'image' => 'uploads/images/'.$new_gambar,
                        'description' => $request->description,
                    ];
                }
                else{
                    $product = [
                        'name' => $request->name,
                        'price' => $request->price,     
                        'qty' => $request->qty,                         
                        'description' => $request->description,
                    ];
                }
                $product_id->update($product);
                $message = 'Data Berhasil di update';

                DB::commit();
                return redirect($request->redirect_to)->with('success',$message);   
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

                Product::create([
                        'name' => $request->name,
                        'price' => $request->price,     
                        'qty' => $request->qty,          
                        'image' => 'uploads/images/'.$new_gambar,
                        'description' => $request->description,
                ]);        

                Image::make($gambar->getRealPath())->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/images/' . $new_gambar));

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
        return view('product.edit',compact('product'));
    }

    public function destroy(Request $request,$id){
        DB::beginTransaction();

        try{
        $product = Product::find($id);
        $product->delete();
        File::delete(public_path($product->image));       

        DB::commit();
        return redirect($request->redirect_to)->with('success','Product berhasil dihapus');                             
        }
        catch(\Exeception $e){
            DB::rollback();            
        }  

        return redirect($request->redirect_to)->with('error',$e);
    }

    
}
