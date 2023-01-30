@extends('layout')

@section('content')
    <div class="container">
        <h1 align="center">My Gallery</h1>
        <div class="row">
            @foreach($imagesInView as $image)
                <div class="col-md-3 gallery-item">
                    <div>
                        <img class="img-thumbnail" src="{{$image->image}}" alt="">
                        <div class="d-grid gap-2">
                            <a href="/show/{{$image->id}}" class="btn btn-info">Show</a>
                            <a href="/edit/{{$image->id}}" class="btn btn-warning">Edit</a>
                            <a href="/delete/{{$image->id}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
