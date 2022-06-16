<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    //
    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.homeabout.index',compact('homeabout'));
    }

    public function AddAbout()
    {
        return view('admin.homeabout.create');
    }

    public function StoreAbout(Request $request)
    {
        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at'=> Carbon::now()
        ]);
        $notification = array(
            'message' => 'About Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('home.about')->with($notification);
    }
    public function EditAbout($id)
    {
        $homeabout = HomeAbout::find($id);
        return  view('admin.homeabout.edit',compact('homeabout'));
    }
    public function UpdateAbout(Request $request, $id)
    {
       $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis
            
        ]);
        $notification = array(
            'message' => 'About Updated Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->route('home.about')->with($notification);
    }

    public function DeleteAbout($id)
    {
        $delete = HomeAbout::find($id)->Delete();
        $notification = array(
            'message' => 'About Deleted Successfully',
            'alert-type'=>'error'
        );
        return Redirect()->route('home.about')->with($notification);
    }
    public function portfolio()
    {
        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
