@extends('admin.admin_master')  
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

        <h4>Home Services</h4>
        <a href="{{route('add.service')}}" class="ml-auto"><button class="btn btn-info ">Add Services</button></a>
<br><br>
                <div class="col-md-12">
                    <div class="card">
                  
                        <div class="card-header">All Services</div>
                    
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" width="5%">SL</th>
                    <th scope="col" width="15%">Services Title</th>
                    <th scope="col" width="25%">Short Description</th>
                    <th scope="col" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                     @php($i=1)
                   @foreach($homeservice as $service)
                    <tr>
                    <th scope="row">{{ $i++}}</th>
                    <td>{{ $service->title}}</td>
                    <td>{{ $service->short_dis}}</td>
                    
                    <td>
                        <a href="{{ url('service/edit/'.$service->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ url('service/delete/'.$service->id) }}" onclick="return confirm('Are you sure to delete!')" class="btn btn-danger">Delete</a>
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

