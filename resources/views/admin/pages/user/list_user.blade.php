@extends('admin.layouts.master')

@section('title')
    Danh sách tài khoản
@endsection

@section('content')
    <style type="text/css">
        .none_radius {
            border-radius: 0 !important;
        }
        label{
            margin-bottom: 3px !important;
            font-size: 11px;
            text-transform: uppercase;
        }
        .form-group{
            margin-bottom: 5px;
        }
        .form-control{
            background: linear-gradient(to right, white , #f5f5f5 70% );
            height: 30px;
            padding: 5px;
        }
        .modal-header{
            padding: 5px 1rem;
            background: #e74c3c;
            border-radius: 0;
            color: white;
        }
        .avatar_edit{
            width: 150px;
            padding: 3px;
            border: 1px solid #eee;
            height: 150px;
            float: right;
        }
        .non-min-width {
            min-width: 0;
            left: -106px !important;

        }
    </style>
    @if(session('noti1'))
        <script type="text/javascript">
            alert("{{ session('noti1') }}");
        </script>
    @endif
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Danh Sách Người Dùng</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
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
                                @php
                                    $cnt = 0;

                                @endphp
                                @foreach($user as $value)
                                    @php
                                        $cnt+=1;

                                    @endphp

                                    <tr>
                                        <td>{{ $cnt}}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>
                                            <b>SỐ ĐIỆN THOẠI</b> :{{ $value->phone }}
                                            <br/>
                                            <b>HÌNH MINH HỌA</b> :
{{--                                            @php--}}
{{--                                                if($value->avatar=='') {--}}
{{--                                                    $avatar = 'default.png';--}}
{{--                                                }--}}
{{--                                                else {--}}
{{--                                                    $avatar = $value->avatar;--}}
{{--                                                }--}}
{{--                                            @endphp--}}
                                            <img  alt="avatar" width="100px" height="100px">
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
                                        <td style="width: 5%; text-align: center;" align="center">
                                            <div class="dropdown width-size-sm">
                                                <button type="button" class="btn btn-xs dropdown-toggle" style="background-color: #fff; border: 1px solid #eee; border-radius: 5px; padding: 3px;" data-toggle="dropdown">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                                <div class="dropdown-menu none-min-width">
                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#myModal_{{$cnt}}" data-backdrop="false"><i class="fa fa-pencil-square-o"></i> Sửa</a>
                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#myModal2_{{$cnt}}" data-backdrop="false"><i class="fa fa-trash-o"></i> Xóa</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal" id="myModal_{{$cnt}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content none_radius">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="text-transform: uppercase;">CHỈNH SỬA - <b>{{$value ->name}}</b></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <input style="font-size: 12px;" type="file" name="fmi_avatar_edit_{{$cnt}}" id="fmi_avatar_edit_{{$cnt}}">
                                                                    <input type="hidden" name="fmi_avatar_{{$cnt}}" value="{{$value->avatar}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                @php
                                                                    if($value->avatar =="") {
                                                                        $avatar = "default.png";
                                                                    }
                                                                    else {
                                                                        $avatar = $value->avatar;
                                                                    }
                                                                @endphp

                                                                <div class="form-group" style="vertical-align: middle;">
                                                                    <img class="avatar_edit" id="pre_avatar_{{$cnt}}" src="{{asset('img/upload/user/').'/'}}{{$avatar}}" alt="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="fullname"><b>Họ và tên</b></label>
                                                                    <input class="form-control none_radius" style="font-size: 12px;" type="text" name="fmi_fullname_edit_{{$cnt}}" value="{{$value -> name}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group" style="vertical-align: middle;">
                                                                    <label for="email"><b>Email</b></label>
                                                                    <input class="form-control none_radius" style="font-size: 12px;" type="text" name="fmi_email_edit_{{$cnt}}" value="{{$value -> email}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group" style="vertical-align: middle;">
                                                                    <label for="phone"><b>Số điện thoại</b></label>
                                                                    <input class="form-control none_radius" style="font-size: 12px;" type="text" name="fmi_phone_edit_{{$cnt}}" value="{{$value -> phone}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group" style="vertical-align: middle;">
                                                                    <label for="password"><b>Mật khẩu cũ</b></label>
                                                                    <input class="form-control none_radius" style="font-size: 12px;" type="text" name="fmi_pass_old_edit_{{$cnt}}" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="fullname"><b>Mật khẩu mới</b></label>
                                                                    <input class="form-control none_radius" style="font-size: 12px;" type="text" name="fmi_pass_new_edit_{{$cnt}}" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group" style="vertical-align: middle;">
                                                                    <label for="email"><b>Nhập lại mật khẩu mới</b></label>
                                                                    <input class="form-control none_radius" style="font-size: 12px;" type="text" name="fmi_pass_new2_edit_{{$cnt}}" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">

                                                                <div class="form-group" style="vertical-align: middle;">
                                                                    @php
                                                                        if($value ->role == 1) {
                                                                            $selected1 = "selected";
                                                                            $selected2 ="";
                                                                            $selected3 ="";
                                                                        }
                                                                        else if($value ->role == 2) {
                                                                            $selected1 = "selected";
                                                                            $selected2 ="";
                                                                            $selected3 ="";
                                                                        }
                                                                        else {
                                                                            $selected1 ="";
                                                                            $selected3 = "selected";
                                                                            $selected2 ="";
                                                                        }
                                                                    @endphp
                                                                    <label for="role"><b>Chức vụ</b></label>
                                                                    <select class="form-control none_radius" style="font-size: 12px" name="fmi_role_edit_{{$cnt}}">
                                                                        <option value="1" {{$selected1}} style="font-size: 12px">Admin</option>
                                                                        <option value="2" {{$selected2}} style="font-size: 12px">Quản lý Danh Mục</option>
                                                                        <option value="3" {{$selected3}} style="font-size: 12px">Quản lý bán hàng</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-danger" style="font-size: 11px; border-radius:2px; font-weight: 700;" name="edit_user_{{$cnt}}" value="LƯU">
                                                    </div>
                                                    <input type="hidden" name="id_user_{{$cnt}}" value="{{$value->id}}">
                                                </form>
                                            </div>
                                        </div>

                                    </div>
{{--                                    <div class="modal" id="myModal2_{{$cnt}}">--}}
{{--                                        <div class="modal-dialog">--}}
{{--                                            <div class="modal-content none_radius">--}}

{{--                                                <!-- Modal Header -->--}}
{{--                                                <div class="modal-header">--}}
{{--                                                    <h4 class="modal-title" style="text-transform: uppercase;">XÓA - <b></b></h4>--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                                                </div>--}}

{{--                                                <!-- Modal body -->--}}
{{--                                                <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">--}}
{{--                                                    <div class="modal-body">--}}
{{--                                                        <p> Bạn có muốn xóa không ?</p>--}}
{{--                                                        <input type="hidden" name="menu_tab1_" value="">--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Modal footer -->--}}
{{--                                                    <div class="modal-footer">--}}
{{--                                                        <a class="btn btn-danger" href="{{Route('admin/del',['id'=>$value->id])}}" >XÓA</a>--}}
{{--                                                        <button type="button" href="{{ Route('admin/quan-ly-nguoi-dung') }}" class="btn btn-danger" > CLOSE</button>--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
    <script type="text/javascript">
        // javascript hiển thị ảnh xem trước khi upload file
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var cnt_input = input.name.split("fmi_avatar_edit_")[1];
                    $('#pre_avatar'+cnt_input).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
