@extends('admin.layouts.master')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('content')
    <div class="card-header">
        <strong class="card-title">Thêm mới sản phẩm</strong>
    </div>
    <div class="card-body card-block" style=" margin: 5px;">
        <form action="{{Route('product.store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <br>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
                @error('name')
                    <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Mô tả sản phẩm</label>
                <br>
                <textarea type="text" name="description" cols="5" rows="5" class="form-control" id="editor1" placeholder="Nhập mô tả sản phẩm"></textarea>
                @error('description')
                    <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Số lượng</label>
                <input type="number" value="1" class="form-control" name="quantity" min="1">
                @error('quantity')
                <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Đơn giá</label>
                <input type="text" name="price" class="form-control" placeholder="Nhập đơn giá sản phẩm" >
                @error('price')
                <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Khuyến mãi</label>
                <input type="text" name="promotional" class="form-control" value="0" placeholder="Nhập đơn giá khuyến mãi nếu có sản phẩm">
                @error('promotional')
                <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="image" class="form-control"     >
                @error('image')
                <div class="alert alert-danger" style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <br>
                <select class="form-control catePro" name="idCategories">
                    @foreach($categories as $cate)
                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Loại sản phẩm</label>
                <br>
                <select class="form-control proTypePro" name="idProductType">
                    @foreach($producttype as $pro)
                    <option value="{{$pro->id}}">{{$pro->name}}</option>
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
@section('js')
    <script>CKEDITOR.replace('editor1');</script>
@endsection
