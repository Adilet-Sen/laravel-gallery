@extends('layout')

@section('content')
    <div class="container">
        <h1>Edit Image</h1>
        <div class="row">
            <div class="col-md-3">
                <img src="/{{$imageInView->image}}" class="img-thumbnail">
            </div>
            <form class="form" action="/update/{{$imageInView->id}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-control mb-1">
                    <input name="image" type="file">
                </div>
                <button class="btn btn-success my-btn" type="submit">Update Image</button>
            </form>
        </div>
    </div>
@endsection
