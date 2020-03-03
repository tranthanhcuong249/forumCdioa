@extends('admin.layouts.master')

@section('title')
    Add Category
@endsection

@section('content')
    <div class="card-header">
        <strong class="card-title">Add Categories</strong>
    </div>
    <div class="card-body card-block" style=" margin: 5px;">
        <form action="{{Route('categories.store')}}" method="post" >
            @csrf
            <div class="form-group">
                <label>Name Category</label>
                <br>
                <input type="text" id="username3" name="name" class="form-control" placeholder="Enter the name of the category">
            </div>
            <div class="form-group">
                <label>Status Category</label>
                <br>
                <select class="form-control" name="status">
                    <option value="1">Display</option>
                    <option value="0">Not Display</option>
                </select>
            </div>
            <div class="form-actions form-group">
                <button style="float: right" type="submit" class="btn btn-success btn-sm">Submit</button>
                <button style="float: right" type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </div>
@endsection
