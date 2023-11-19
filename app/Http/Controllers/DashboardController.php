<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $today_money = DB::table('orders')->where('status_order', '<>', 3)->whereDate('created_at', '=', now()->toDateString())->sum('total');
        $today_orders = DB::table('orders')->whereDate('created_at', '=', now()->toDateString())->count('id');
        $client = DB::table('users')->where('deleted_at', '=', null)->count('id');
        $new_client = DB::table('users')->whereDate('created_at', '=', now()->toDateString())->count('id');
        $sales = DB::table('orders')->where('status_order', '=', 2)->sum('total');
        $data_header = [$today_money, $today_orders, $new_client, $sales, $client];

        $count_item = DB::table('books')->where('deleted_at', '=', null)->count('id');
        // dd($chart);
        //Chart 1
        $range = Carbon::now()->subDays(30);
        $stats = DB::table('orders')
            ->where('created_at', '>=', $range)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as value'),
                DB::raw('SUM(total) as sum')
            ]);
        $day = [];
        $count = [];
        $sum = 0;
        foreach ($stats as $key) {
            $day[] = $key->date;
            $count[] = $key->value;
            $sum += $key->sum;
        }
        $label = json_encode($day);
        $data = json_encode($count);
        $chart1 = [$label, $data, $sum];
        //Chart 2
        $range2 = Carbon::now()->subYear();
        $stats2 = DB::table('orders')
            ->where('created_at', '>=', $range2)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as value'),
                DB::raw('SUM(total) as sum')
            ]);
        $day2 = [];
        $count2 = [];
        $sum2 = 0;
        foreach ($stats2 as $key) {
            $day2[] = $key->date;
            $count2[] = $key->value;
            $sum2 += $key->sum;
        }
        $chart2 = [json_encode($day2), json_encode($count2), $sum2];
        $chart = DB::table('books')->leftJoin('order_details', 'books.id', '=', 'order_details.id_book')->select('books.id', DB::raw('COUNT(id_book) as count'), DB::raw('SUM(order_details.price) as total'))->where('books.deleted_at', '=', null)->groupBy('books.id')->get();
        $name = []; //chua name book
        $count_chart_3 = [];
        foreach ($chart as $item) {
            $name[] = Book::find($item->id)->name;
            $count_chart_3[] = $item->count;
        }
        $chart3 = [json_encode($name),json_encode($count_chart_3)];
        return view('layout.dashboard', compact('data_header', 'chart1', 'chart2','chart3'));
    }
}