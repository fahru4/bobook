<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    use HasFactory;
    protected $casts = [
        'approve' => 'boolean',
      ];
    // protected $guarded = [];


    protected $fillable = [
        'user_id', 'member_id', 'book_id', 'approve', 'date_loan', 'date_return'
    ];

    public function member(){
        return $this->belongsTo('App\Models\Member','member_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function books(){
        return $this->belongsTo('App\Models\Book','book_id');
    }
}
