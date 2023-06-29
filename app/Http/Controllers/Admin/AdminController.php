<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $is = Transaction::where('approve', '=', 1)->count();
        $no = Transaction::where('approve', '=', 0)->count();
        return view('pages.admin.index',compact('is','no'));

    }
}
