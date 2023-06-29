<?php

namespace App\Http\Controllers\Member;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(){
        $is = Transaction::where('approve', '=', 1)->count();
        return view('pages.member.index',compact('is'));

    }
}
