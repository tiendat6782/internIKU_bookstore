<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use DB;

class RateController extends Controller
{
    public function view()
    {
        $title = 'List Rate';
        $rate = DB::table('rates')->join('users', function (JoinClause $join) {
            $join->on('rates.id_user', '=', 'users.id');
        })->join('books',function (JoinClause $joinClause)  {
            $joinClause->on('rates.id_book','=','books.id');
        })->select('rates.*','users.name as user','users.image','books.name')->paginate(4);
       return view('layout.admin.rate.view',compact('rate','title'));
    }
}