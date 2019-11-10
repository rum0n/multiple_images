@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-12">

          @if($errors->all())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e)
                 <li>{{$e}}</li>  
                @endforeach
                {{session('success')}}
              </div>
          @endif


          {{-- @if(session('success'))
              <div class="alert alert-success">
                {{session('success')}}
              </div>
          @endif --}}

          <form class="form-group" action="{{route('pic_upload')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
              <label for="exampleInputTitle1">Post Title</label>
              <input type="text" class="form-control" id="exampleInputTitle1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="post_title">
          </div>
          
          <div class="form-group">
              <label for="exampleInputpic1">Pictures</label>
              <input type="file" class="form-control" id="exampleInputpic1" aria-describedby="emailHelp" name="images[]" multiple>
          </div>

          <button type="submit" class="btn btn-primary">Add Pictures</button>
        </form>
      </div>

      
    </div>

    <div class="row">
      <div class="col-md-12 ">
        <table class="table table-bordered table-striped table-hover">
          <tr>
          <th>SI.</th>
          <th>Title</th>
          <th>Pictures</th>
          <th>Action</th>
        </tr>
        @foreach($post as $x)
        <tr>
          <td>{{$loop->index + 1}}</td>
          <td>{{ $x->title }}</td>

          @if ($x->pic != "")
            <td>
              @foreach(explode('|', $x->pic) as $y)
              
                <img src="{{asset('images/'.$y)}}" alt="" class="img img-responsive img-thumbnail" width="100">
              
              @endforeach
            </td>
          @endif
          <td>
            <a href="{{ url('/picture/edit/'.$x->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ url('/picture/delete/'.$x->id) }}" class="btn btn-danger">Delete</a>
          </td>
        </tr>

        @endforeach
        </table>
      </div>
    </div>
   </div>
  @endsection