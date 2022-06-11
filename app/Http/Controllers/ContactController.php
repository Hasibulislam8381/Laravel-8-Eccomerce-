<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Contactform;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
  public function AdminContact()
  {
      $contacts = Contact::all();
      return view('admin.contact.index',compact('contacts'));
  }
  public function AddContact()
  {
      return view('admin.contact.create');
  }
  public function StoreContact(Request $request)
  {
    Contact::insert([
        'address' => $request->address,
        'email' => $request->email,
        'phone' => $request->phone,
        'created_at'=> Carbon::now()
    ]);
    return Redirect()->route('admin.contact')->with('success','Contact Inserted Successfully');
  }

  public function EditContact($id)
  {
    $contacts = Contact::find($id);
    return view('admin.contact.edit',compact('contacts'));
  }
  public function UpdateContact(Request $request,$id)
  {
    $update = Contact::find($id)->update([
      'address' => $request->address,
      'email' => $request->email,
      'phone' => $request->phone
      
  ]);
  return Redirect()->route('admin.contact')->with('success','Contact Updated Successfully');
  }
  public function DeleteContact($id)
  {
    $delete = Contact::find($id)->Delete();
        return Redirect()->back()->with('success','Contact Deleted Successfully');
  }
  public function Contact()
  {
    $contacts = DB::table('contacts')->first();
    return view('pages.contact',compact('contacts'));
  }

  public function ContactForm(Request $request)
  {
    Contactform::insert([
      'name' => $request->name,
      'email' => $request->email,
      'subject' => $request->subject,
      'message' => $request->message,
      'created_at'=> Carbon::now()
  ]);
  return Redirect()->route('contact')->with('success','Your message has been sent Successfully');
  }

  public function ContactMessage()
  {
    $messages = Contactform::all();
    return view('admin.contact.message',compact('messages'));
  }

  public function ContactMessageDelete($id)
  {
    $messages = Contactform::find($id)->delete();
    return redirect()->back()->with('success','User Message Deleted Successfully');
  }
}

