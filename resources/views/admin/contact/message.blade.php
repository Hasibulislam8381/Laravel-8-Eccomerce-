@extends('admin.admin_master')  
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

        <h4>User Message</h4>
        
<br><br>
                <div class="col-md-12">
                    <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="card-header">All Contact Messages</div>
                    
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" width="5%">SL</th>
                    <th scope="col" width="15%">User Name</th>
                    <th scope="col" width="25%">User Email</th>
                    <th scope="col" width="15%">Subject</th>
                    <th scope="col" width="15%">Message</th>
                    <th scope="col" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                     @php($i=1)
                   @foreach($messages as $message)
                    <tr>
                    <th scope="row">{{ $i++}}</th>
                    <td>{{ $message->name}}</td>
                    <td>{{ $message->email}}</td>
                    <td>{{ $message->subject}}</td>
                    <td>{{ $message->message}}</td>
                    
                    <td>
                        <a href="{{ url('contact/message/delete/'.$message->id) }}" onclick="return confirm('Are you sure to delete!')" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                 
                </tbody>
            </table>
             
                  </div>
                </div>

            </div>
        </div>
     
    </div>
    @endsection

