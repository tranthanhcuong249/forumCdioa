@extends('admin.layouts.master')

@section('title')
    Category
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Categories</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN DANH MỤC</th>
                                        <th>TÊN KHÔNG DẤU</th>
                                        <th>STATUS</th>
                                        <th>CHỈNH SỬA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($categories as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->slug }}</td>
                                            <td>
                                                @if($value->status==1)
                                                    {{ "Display" }}
                                                @else
                                                    {{ "Not Display" }}
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary edit" data-id="{{ $value->id }}" data-backdrop="false" data-toggle="modal"
                                                        data-target="#update1" title="{{ "Sủa".$value->name }}" ><i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-danger delete"  data-id="{{ $value->id }}" data-backdrop="false" data-toggle="modal"
                                                        data-target="#delete" title="{{ "Xóa".$value->name }}" ><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $users->links() }}
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
                                <label>Name Category</label>
                                <input type="text" class="form-control namecat"  name="name"  placeholder="Enter the name of the category" >
                                <div class="error" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Status Category</label>
                                <select class="form-control status" name="status">
                                    <option class="ht" value="1">Display</option>
                                    <option class="kht" value="0">Not Display</option>
                                </select>
                            </div>
                            <div class="form-actions form-group">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="update" style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Cập Nhật</button>
                                    <button type="submit" class="btn btn-success " style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Làm lại</button>
                                    <button type="submit" class="btn btn-danger " style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Cancle</button>
                                </div>
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
                        <a class="btn btn-danger del" href="" >XÓA</a>
                        <button type="button" href="" class="btn btn-danger" >KHÔNG</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
