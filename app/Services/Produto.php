<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Produto extends Model {
    protected $fillable = ['nome_produto', 'cod_categoria_produto'];
    public $timestamps = false;

    public function produto(Request $request){
        DB::beginTransaction();
    }
}
