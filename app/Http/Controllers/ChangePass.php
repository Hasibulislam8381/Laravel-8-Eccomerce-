<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\support\Facades\Hash;
class ChangePass extends Controller
{
    //
    public function Cpassword()
    {
        return view('admin.body.changepassword');
    }
    public function PassUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword'=> 'required',
            'password'=>'required|confirmed'

        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword))
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password Has Changed successfully');
        }else{
            return redirect()->back()->with('error','Current Password is invalid');

        }
    }
    public function Pupdate()
    {
        if(Auth::User()){
            $user = User::find(Auth::user()->id);
            if($user)
            {
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }

    public function Profileupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return Redirect()->back()->with('success','Profile Updated Successfully');
        }else
        {
            return Redirect()->back()->with('error','Failed to update');
        }
    }
}
