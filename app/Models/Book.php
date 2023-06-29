<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'code_book', 'title', 'pub_year', 'author', 'stock', 'photo'
    ];

    // protected $guarded = [];
    public function transactionAll(){
        return $this->hasMany(Transaction::class,'book_id');
    }

}
