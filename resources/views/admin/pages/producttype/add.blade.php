@extends('admin.layouts.master')

@section('title')
    Thêm mới loại sản phẩm
@endsection

@section('content')
    <div class="card-header">
        <strong class="card-title">Thêm mới loại sản phẩm</strong>
    </div>
    <div class="card-body card-block" style=" margin: 5px;">
        <form action="{{Route('producttype.store')}}" method="post" >
            @csrf
            <div class="form-group">
                <label>Tên loại sản phẩm</label>
                <br>
                <input type="text" id="username3" name="name" class="form-control" placeholder="Nhập tên loại sản phẩm">
                @error('name')
                    <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <br>
                <select class="form-control" name="idCategories">
                    @foreach($category as $cate)
                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <br>
                <select class="form-control" name="status">
                    <option value="1">Hiển thị</option>
                    <option value="0">Không hiển thị</option>
                </select>
            </div>
            <div class="form-actions form-group">
                <button style="float: right" type="submit" class="btn btn-success btn-sm">THÊM</button>
            </div>
        </form>
    </div>
@endsection
