<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
class BookController extends Controller
{
    public function __construct()
    {
        $this->category = new Category();
        $this->book = new Book();
    }
    public function view(Request $request)
    {
        $title = 'List Cate';
        $books = Book::paginate(4);
        return view('layout.admin.book.view', compact('title', 'books'));
    }
    public function insert(BookRequest $request)
    {
        $cate = $this->category::all();
        if ($request->isMethod('post')) {
            $param = $request->post();
            unset($param['_token']);
            if ($request->hasFile('image')&& $request->file('image')->isValid()) {
               $param['image'] = $this->uploadFile('image',$request->file('image'));
            }
            if ($this->book->create($param)) {
                Session::flash('success','Insert Success');
                return redirect()->route('book');
            }else {
                Session::flash('errors','Fail insert ');
                return redirect()->route('book');
            }
        }
        return view('layout.admin.book.add',compact('cate'));
    }

    public function view_delete(Request $request)
    {
        $title = 'List deleted Book';
        $deleted = Book::onlyTrashed()->paginate(5);
        return view('layout.admin.book.softdelete', compact('deleted', 'title'));
    }
    public function delete($id)
    {
        if ($id) {
            $delete = Book::where('id', $id)->delete();
            if ($delete) {
                Session::flash('success', 'Delete Success');
                return redirect()->route('book');
            } else {
                Session::flash('errors', 'Fail Delete');
                return redirect()->route('book');
            }
        }
    }
    public function force($id)
    {
        if ($id) {
            $delete = Book::withTrashed()->where('id', $id)->forceDelete();
            if ($delete) {
                Session::flash('success', 'Delete Success');
                return redirect()->route('view_delete_book');
            } else {
                Session::flash('errors', 'Fail Delete');
                return redirect()->route('view_delete_book');
            }
        }
    }
    public function restore($id)
    {
        if ($id) {
            $restore = Book::withTrashed()->where('id', $id)->restore();
            if ($restore) {
                Session::flash('success', 'Restore Success');
                return redirect()->route('view_delete_book');
            } else {
                Session::flash('errors', 'Fail Restore');
                return redirect()->route('view_delete_book');
            }
        }
    }
    public function edit($id, Request $request)
    {
        $book = Book::find($id);
        $cate = Category::all();
        if ($request->isMethod('post')) {
            $param = $request->post();
            $param['image'] = $book->image;
            unset($param['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($this->deleteFile($book->image)) {
                    $param['image'] = $this->uploadFile('image', $request->file('image'));
                }
            }
            $update = Book::where('id', $id)->update($param);
            if ($update) {
                Session::flash('success', 'Update Success');
                return redirect()->route('book');
            } else {
                Session::flash('errors', 'Fail update');
                return redirect()->route('edit_book', ['id' => $id]);
            }
        }
        return view('layout.admin.book.edit', compact('book','cate'));
    }
}