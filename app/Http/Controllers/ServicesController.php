<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeService;
use Illuminate\Support\Carbon;

class ServicesController extends Controller
{
    //
    public function HomeService()
    {
        $homeservice = HomeService::latest()->get();
        return view('admin.homeservice.index',compact('homeservice'));
    }
    public function AddService()
    {
        return view('admin.homeservice.create');
    }
    public function StoreService(Request $request)
    {
        HomeService::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->route('home.services')->with('success','Services Inserted Successfully');
    }
    public function EditService($id)
    {
        $homeservice = HomeService::find($id);
        return  view('admin.homeservice.edit',compact('homeservice'));
    }
    public function UpdateService(Request $request,$id)
    {
        $update = HomeService::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            
        ]);
        return Redirect()->route('home.services')->with('success','Services Updated Successfully');
    }

    public function DeleteService($id)
    {
        $delete = HomeService::find($id)->Delete();
        return Redirect()->back()->with('success','Service Deleted Successfully');
    }
}
