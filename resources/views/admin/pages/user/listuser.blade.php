@extends('admin.layouts.master')

@section('title')
    Danh sách tài khoản
@endsection
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">QUẢN LÝ TÀI KHOẢN</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>THÔNG TIN</th>
                                        <th>ROLE</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>CHỈNH SỬA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($user as $key => $value)
                                        <tr>


                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                <b>MẠNG XÃ HỘI</b> :{{ $value->social_id }}
                                                <br/>
                                                <b>SỐ ĐIỆN THOẠI</b> :{{ $value->phone }}
                                                <br/>
                                                <b>HÌNH MINH HỌA</b> :
                                            @php
                                                if($value->avatar=='') {
                                                    $avatar = 'default.png';
                                                }
                                                else {
                                                    $avatar = $value->avatar;
                                                }
                                                @endphp
                                                    <img src="img/upload/user/{{ $avatar }}"  alt="avatar" width="100px" height="100px">
                                            </td>
                                            <td>
                                                @if($value->role==1)
                                                    {{ "Admin" }}
                                                @elseif($value->role==2)
                                                    {{ "Quản lý danh mục" }}
                                                @elseif($value->role==3)
                                                    {{ "Nhân viên bán hàng" }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($value->status==0)
                                                    {{ "Ok" }}
                                                @else
                                                    {{ "No" }}
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary editUser" data-id="{{ $value->id }}" style="width: 45px; border-radius: 4px;" data-backdrop="false" data-toggle="modal"
                                                        data-target="#update1" title="{{ "Sủa".$value->name }}" ><i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-danger deleteUser" style="width: 45px; border-radius: 4px;"  data-id="{{ $value->id }}" style="width: 45px" data-backdrop="false" data-toggle="modal"
                                                        data-target="#delete" title="{{ "Xóa".$value->name }}" ><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
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
                                                            <form role="form" enctype="multipart/form-data" >
                                                                <div class="form-group">
                                                                    <label>Tên tài khoản</label>
                                                                    <br>
                                                                    <input type="text" name="name" class="form-control nameUser" placeholder="Nhập tên tài khoản">
                                                                    <div class="alert alert-danger errorName" style="color: red"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Địa chỉ Email</label>
                                                                    <br>
                                                                    <input type="text" name="email" class="form-control emailUser" placeholder="Nhập mô tả sản phẩm">
                                                                    <div class="alert alert-danger errorEmail" style="color: red"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="text" name="password" class="form-control passwordUser" placeholder="Nhập password muốn thay đổi" >
                                                                    <div class="alert alert-danger errorPassword" style="color: red"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Số điện thoại</label>
                                                                    <input type="text" name="phone" class="form-control phoneUser" placeholder="Nhập số điện thoại" >
                                                                    <div class="alert alert-danger errorPhone" style="color: red"></div>
                                                                </div>
                                                                <img class="img img-thumbnail imageThum" width="100px" height="100px" align="center">
                                                                <div class="form-group">
                                                                    <label>Hình ảnh</label>
                                                                    <input type="file" name="avatar" class="form-control avatarUser"     >
                                                                    <div class="alert alert-danger errorAvatar" style="color: red"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Quyền</label>
                                                                    <br>
                                                                    <select class="form-control roleUser" name="role">
                                                                        <option class="admin" value="1">Admin</option>
                                                                        <option class="qldm" value="2">Quản lý danh mục</option>
                                                                        <option class="nvbh" value="3">Nhân viên bán hàng</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Trạng thái</label>
                                                                    <br>
                                                                    <select class="form-control statusUser" name="status">
                                                                        <option class="ht" value="1">Hiển thị</option>
                                                                        <option class="kht" value="0">Không hiển thị</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-actions form-group">
                                                                    <input type="submit" class="btn btn-primary updatePro" style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;" value="Sửa"/>
                                                                    <button type="button" class="btn btn-success " style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;">Làm lại</button>
                                                                    <button type="button" class="btn btn-danger " style="font-size: 11px; border-radius:2px;
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
                                                            <a class="btn btn-danger delPro" href="" >XÓA</a>
                                                            <button type="button" href="" class="btn btn-danger" >KHÔNG</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
{{--                <div class="text-center">{{ $product->links() }}</div>--}}
            </div>
        </div>
        <!-- .animated -->
    </div>
@endsection

