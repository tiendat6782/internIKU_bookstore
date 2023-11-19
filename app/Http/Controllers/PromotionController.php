<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use Session;

class PromotionController extends Controller
{
    public function __construct() {
        $this->promotion = new Discount();
    }
    public function view(Request $request)
    {
        $title = 'List Promotion';
        $khuyenMai = Discount::paginate(4);
        return view('layout.admin.promotion.view', compact('title', 'khuyenMai'));
    }
    public function insert(Request $req)
    {
        if ($req->isMethod('post')) {
            $param = $req->post();
            unset($param['_token']);
            if ($this->promotion->create($param)) {
                Session::flash('success', 'Insert Successfully');
                return redirect()->route('promotion');
            } else {
                Session::flash('success', 'Insert Failly');
                return redirect()->route('insert_promotion');
            }

        }
        return view('layout.admin.promotion.add');
    }
    public function update($id, Request $req)
    {
        $khuyenmai = Discount::find($id);
        if ($req->isMethod('post')) {
            $param = $req->post();
            unset($param['_token']);
            $updated = Discount::where('id', $id)->update($param);
            if ($updated) {
                Session::flash('success', 'Insert Successfully');
                return redirect()->route('promotion');
            } else {
                Session::flash('success', 'Insert Failly');
                return redirect()->route('edit_promotion');
            }

        }
        return view('layout.admin.promotion.edit', compact('khuyenmai'));
    }
    public function view_delete()
    {
        $title = "List Deleted Promotion";
        $deleted = Discount::onlyTrashed()->paginate(4);
        return view('layout.admin.promotion.softdelete', compact('deleted', 'title'));
    }
    public function delete($id)
    {
        $delete = Discount::where('id', $id)->delete();
        if ($delete) {
            Session::flash('success', 'Delete Successfully');
            return redirect()->route('promotion');
        } else {
            Session::flash('success', 'Delete Failly');
            return redirect()->route('promotion');
        }
    }
    public function force($id)
    {
        $force = Discount::withTrashed()->where('id', '=',$id)->forceDelete();
        if ($force) {
            Session::flash('success', 'Delete Successfully');
            return redirect()->route('view_delete_promotion');
        } else {
            Session::flash('success', 'Delete Failly');
            return redirect()->route('view_delete_promotion');
        }
    }
    public function restore($id)
    {
        $restore = Discount::withTrashed()->where('id','=',$id)->restore();
        if ($restore) {
            Session::flash('success', 'Restore Successfully');
            return redirect()->route('view_delete_promotion');
        } else {
            Session::flash('success', 'Restore Failly');
            return redirect()->route('view_delete_promotion');
        }
    }
}