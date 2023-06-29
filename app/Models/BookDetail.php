<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;
    public $table = "detail_books";

    protected $guarded = [];

    // public function transactionAll(){
    //     return $this->hasMany(Transaction::class,'book_id');
    // }

}
