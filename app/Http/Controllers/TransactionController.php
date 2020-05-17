<?php

namespace App\Http\Controllers;
//© 2020 Copyright: Tahu Coding
use Illuminate\Http\Request;
use App\Product;
use App\Transaction;

use Darryldecode\Cart\CartCondition;

//import dulu packagenya biar bs dipake
use Haruncpi\LaravelIdGenerator\IdGenerator;


class TransactionController extends Controller
{
    public function index(){    
             
        //product
        $products = Product::when(request('search'), function($query){
                        return $query->where('name','like','%'.request('search').'%');
                    })
                    ->orderBy('created_at','desc')
                    ->paginate(12);


        //cart item
        if(request()->tax){
            $tax = "+10%";
        }else{
            $tax = "0%";
        }

        $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'pajak',
                'type' => 'tax', //tipenya apa
                'target' => 'total', //target kondisi ini apply ke mana (total, subtotal)
                'value' => $tax, //contoh -12% or -10 or +10 etc
                'order' => 1
            ));                
            
        \Cart::session(Auth()->id())->condition($condition);          

        $items = \Cart::session(Auth()->id())->getContent();
        
        if(\Cart::isEmpty()){
            $cart_data = [];            
        }
        else{
            foreach($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                    'created_at' => $row->attributes['created_at'],
                ];           
            }
            
            $cart_data = collect($cart)->sortBy('created_at');

        }
        
        //total
        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $new_condition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $new_condition->getCalculatedValue($sub_total); 

        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total,
            'tax' => $pajak
        ];

        //kembangin biar no reload make ajax
        //saran bagi yg mau kembangin bisa pake jquery atau .js native untuk manggil ajax jangan lupa product, cart item dan total dipisah
        //btw saya lg mager bikin beginian.. jadi sayas serahkan sama kalian ya (yang penting konsep dan fungsi aplikasi dah kelar 100%)

        //kembangin jadi SPA make react.js atau vue.js (tapi bagusnya backend sama frontend dipisah | backend cuma sebagai penyedia token sama restfull api aja)
        //kalau make SPA kayaknya agak sulit deh krn ini package default nyimpan cartnya disession, tapi kalau gak salah didokumentasinya
        //bilang kalau ini package bisa store datanya di database 
        return view('pos.index', compact('products','cart_data','data_total'));
    }

    public function addProductCart($id){
        $product = Product::find($id);      
                
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id);  
      
        if($cek_itemId->isNotEmpty()){
            if($product->qty == $cek_itemId[$id]->quantity){
                return redirect()->back()->with('error','jumlah item kurang');
            }else{
                \Cart::session(Auth()->id())->update($id, array(
                    'quantity' => 1
                ));
            }            
        }else{
             \Cart::session(Auth()->id())->add(array(
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1, 
            'attributes' => array(
                'created_at' => date('Y-m-d H:i:s')
            )          
        ));
        
        }       

        return redirect()->back();
    }

    public function removeProductCart($id){
        \Cart::session(Auth()->id())->remove($id);     
                         
        return redirect()->back();
    }

    public function hitung(){

        $cart_total = \Cart::session(Auth()->id())->getTotal();
        $bayar = request()->bayar;
        $kembalian = (int)$bayar - (int)$cart_total;
        
        if($kembalian < 0){
            return redirect()->back()->with('error','jumlah pembayaran gak valid');
        }

        $id = IdGenerator::generate(['table' => 'transcations', 'length' => 10, 'prefix' =>'INV-', 'field' => 'invoices_number']);
        Transcation::create([
            'invoices_number' => $id,
            'user_id' => Auth::id(),
            'pay' => request()->bayar,
            'total' => $cart_total
        ]);
        //harusnya disini bisa kalian kembangkan dengan cara saya kasih clue
        //ambil semua data dari cart
        //trus buat array baru menggunakan method bawaan laravel collection yaitu map trus loop dan insert deh satu-satu ke table details transaksi yang dalamnya ada transaksi_id
        //kegunaannya adalah agar kalian bisa tracking kedepan dan bs print ulang details transaksinya


        return redirect()->back();
        

    }

    public function clear(){
        \Cart::session(Auth()->id())->clear();
        return redirect()->back();
    }

    public function decreasecart($id){
        $product = Product::find($id);      
                
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id); 

        if($cek_itemId[$id]->quantity == 1){
            \Cart::session(Auth()->id())->remove($id);  
        }else{
            \Cart::session(Auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => true,
                'value' => -1
            )));            
        }
        return redirect()->back();

    }


    public function increasecart($id){
        $product = Product::find($id);     
        
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id); 

        if($product->qty == $cek_itemId[$id]->quantity){
            return redirect()->back()->with('error','jumlah item kurang');
        }else{
            \Cart::session(Auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => true,
                'value' => 1
            )));

            return redirect()->back();
        }        
    }

    
}
//© 2020 Copyright: Tahu Coding
