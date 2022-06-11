<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat()
    {
        $categories=Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index',compact('categories','trashCat'));
    }
    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();
        
        return Redirect()->back()->with('success','Category Inserted Successfully');

    }

    public function Edit($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));

    }
    public function Update(Request $request,$id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
        return Redirect()->route('all.category')->with('success','Category Updated Successfully');

    }
    public function softDelete($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Deleted Successfully');
    }
    public function Restore($id)
    {
      $delete = Category::withTrashed()->find($id)->restore();
      return Redirect()->back()->with('success','Category restore Successfully');
    }
    public function pdelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted');
    }
}