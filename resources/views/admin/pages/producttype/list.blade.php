@extends('admin.layouts.master')

@section('title')
    Danh sách loại sản phẩm
@endsection
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">ProductType</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN DANH MỤC</th>
                                        <th>TÊN KHÔNG DẤU</th>
                                        <th>CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>CHỈNH SỬA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($producttype as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->slug }}</td>
                                            <td>{{ $value->Categories->name }}</td>
                                            <td>
                                                @if($value->status==1)
                                                    {{ "Display" }}
                                                @else
                                                    {{ "Not Display" }}
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary editProType" data-id="{{ $value->id }}" data-backdrop="false" data-toggle="modal"
                                                        data-target="#update1" title="{{ "Sủa".$value->name }}" ><i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-danger deleteProType"  data-id="{{ $value->id }}" data-backdrop="false" data-toggle="modal"
                                                        data-target="#delete" title="{{ "Xóa".$value->name }}" ><i class="fa fa-trash-o"></i></button>
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
        <!-- .animated -->
    </div>
    <div class="modal fade" id="update1">
        <div class="modal-dialog">
            <div class="modal-content none_radius">
                <div class="alert alert-danger" style="display:none"></div>
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="text-transform: uppercase;">Chỉnh Sửa <span class="title" ></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="row" style=" margin: 5px;">
                    <div class="col-lg-12">
                        <form>
                            <div class="form-group">
                                <label>Tên loại sản phẩm</label>
                                <br>
                                <input type="text" id="username3" name="name" class="form-control nameprotype" placeholder="Nhập tên loại sản phẩm">
                                <div class="error" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <br>
                                <select class="form-control idCategories" name="idCategories">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <select class="form-control status" name="status">
                                    <option value="1" class="ht" >Hiển thị</option>
                                    <option value="0" class="ht" >Không hiển thị</option>
                                </select>
                            </div>
                            <div class="form-actions form-group">
                                <button type="button" class="btn btn-primary updateProductype" id="update" style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Cập Nhật</button>
                                <button type="submit" class="btn btn-success " style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Làm lại</button>
                                <button type="submit" class="btn btn-danger " style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Cancle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="delete" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content none_radius">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="text-transform: uppercase;">Xóa <span class="title" ></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form>
                    <div class="modal-body">
                        <p> Bạn có muốn xóa không ?</p>
                        <input type="hidden" name="menu_tab1_" value="">
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a class="btn btn-danger delProType" href="" >XÓA</a>
                        <button type="button" href="" class="btn btn-danger" >KHÔNG</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
