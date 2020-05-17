<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranscation extends Model
{
    //demi keamanan kalian harusnya ubah ini ke fillable ya
    protected $guarded = [];
    protected $table = 'product_transation';

    
    public function product(){
        return $this->belongsTo(Product::class);
    }
   
}
