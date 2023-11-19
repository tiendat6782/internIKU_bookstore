<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->category = new Category();
    }
    public function view(Request $request)
    {
        $title = 'List Cate';
        $categorys = Category::paginate(4);
        return view('layout.admin.category.view', compact('title', 'categorys'));
    }
    public function insert(CategoryRequest $request)
    {
        if ($request->isMethod('post')) {
            $param = $request->post();
            unset($param['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $request->image = $this->uploadFile('image', $request->file('image'));
                $param['image'] = $request->image;
            }
            if ($this->category->create($param)) {
                Session::flash('success', 'Insert Success');
                return redirect()->route('category');
            } else {
                Session::flash('errors', 'Fail Insert');
                return redirect()->route('insert_category');
            }
        }
        return view('layout.admin.category.add');
    }

    public function view_delete(Request $request)
    {
        $title = 'List deleted Category';
        $deleted = Category::onlyTrashed()->paginate(5);
        return view('layout.admin.category.softdelete', compact('deleted', 'title'));
    }
    public function delete($id)
    {
        if ($id) {
            $delete = Category::where('id', $id)->delete();
            if ($delete) {
                Session::flash('success', 'Delete Success');
                return redirect()->route('category');
            } else {
                Session::flash('errors', 'Fail Delete');
                return redirect()->route('category');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = Category::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                Session::flash('success', 'Delete Success');
                return redirect()->route('view_delete_category');
            } else {
                Session::flash('errors', 'Fail Delete');
                return redirect()->route('view_delete_category');
            }
        }
    }
    public function restore($id)
    {
        if ($id) {
            $restore = Category::withTrashed()->where('id', $id)->restore();
            if ($restore) {
                Session::flash('success', 'Restore Success');
                return redirect()->route('view_delete_category');
            } else {
                Session::flash('errors', 'Fail Restore');
                return redirect()->route('view_delete_category');
            }
        }
    }
    public function edit($id, Request $request)
    {
        $category= Category::find($id);
        if ($request->isMethod('post')) {
            $param = $request->post();
            $param['image'] = $category->image;
            unset($param['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($this->deleteFile($category->image)) {
                    $param['image'] = $this->uploadFile('image',$request->file('image')); 
                }
            }
            $update = Category::where('id', $id)->update($param);
            if ($update) {
                Session::flash('success', 'Update Success');
                return redirect()->route('category');
            } else {
                Session::flash('errors', 'Fail update');
                return redirect()->route('edit_category', ['id' => $id]);
            }
        }
        return view('layout.admin.category.edit', compact('category'));
    }
}