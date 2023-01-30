@extends('layout')

@section('content')
    <div class="container">
        <h1>Add Image</h1>
        <div class="row">
            <form class="form" action="/store" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-control mb-1">
                    <input name="image" type="file">
                </div>
                <button class="btn btn-success my-btn" type="submit">Add Image</button>
            </form>
        </div>
    </div>
@endsection
