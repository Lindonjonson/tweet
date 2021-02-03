<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class Tweet extends Model
{
    use HasFactory;
    
    protected $fillable = ['conteudo','id_usuario'];


    public function user(){
        return $this->belongsTo(User::class);
    }

}
