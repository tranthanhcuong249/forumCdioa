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
                                        <th>TÊN SẢN PHẨM</th>
                                        <th>MÔ TẢ</th>
                                        <th>THÔNG TIN</th>
                                        <th>DANH MỤC</th>
                                        <th>LOẠI SẢN PHẨM</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>CHỈNH SỬA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($product as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{!! $value->description !!}</td>
                                            <td>
                                                <b>SỐ LƯỢNG</b> :{{ $value->quantity }}
                                                <br/>
                                                <b>ĐƠN GIÁ</b> :{{ $value->price }}
                                                <br/>
                                                <b>KHUYỂN MÃI</b> :{{ $value->promotional }}
                                                <br/>
                                                <b>HÌNH MINH HỌA</b> :
                                                    <img src="img/upload/product/{{ $value->image }}" width="200px" height="100px">
                                            </td>
                                            <td>{{ $value->Categories->name }}</td>
                                            <td>{{ $value->ProductType->name }}</td>
                                            <td>
                                                @if($value->status==1)
                                                    {{ "Display" }}
                                                @else
                                                    {{ "Not Display" }}
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary editPro" data-id="{{ $value->id }}" style="width: 45px; border-radius: 4px;" data-backdrop="false" data-toggle="modal"
                                                        data-target="#update1" title="{{ "Sủa".$value->name }}" ><i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-danger deletePro"  data-id="{{ $value->id }}" style="width: 45px" data-backdrop="false" data-toggle="modal"
                                                        data-target="#delete" title="{{ "Xóa".$value->name }}" ><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
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
                        <form role="form" id="updateProduct" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <br>
                                <input type="text" name="name" class="form-control namePro" placeholder="Nhập tên sản phẩm">
                                <div class="alert alert-danger errorName" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <br>
                                <textarea type="text" name="description" cols="5" rows="5" class="form-control descriptionPro" id="editor1" placeholder="Nhập mô tả sản phẩm"></textarea>
                                <div class="alert alert-danger errorDescription" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" value="1" class="form-control quantityPro" name="quantity" min="1">
                                <div class="alert alert-danger errorQuantity" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input type="text" name="price" class="form-control pricePro" placeholder="Nhập đơn giá sản phẩm" >
                                <div class="alert alert-danger errorPrice" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Khuyến mãi</label>
                                <input type="text" name="promotional" class="form-control promotionalPro" value="0" placeholder="Nhập đơn giá khuyến mãi nếu có sản phẩm">
                                <div class="alert alert-danger errorPromotional" style="color: red"></div>
                            </div>
                            <img class="img img-thumbnail imageThum" alt="photo" width="100px" height="100px" align="center">
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="image" class="form-control imagePro"     >
                                <div class="alert alert-danger errorImage" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <br>
                                <select class="form-control catePro" name="idCategories">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <br>
                                <select class="form-control proTypePro" name="idProductType">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <select class="form-control statusPro" name="status">
                                    <option class="ht" value="1">Hiển thị</option>
                                    <option class="kht" value="0">Không hiển thị</option>
                                </select>
                            </div>
                            <div class="form-actions form-group">
                                <input type="submit" class="btn btn-primary updateProduct" id="update" style="font-size: 11px; border-radius:2px;
                                                                            font-weight: 700;" value="Sửa"/>
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
                        <a class="btn btn-danger delPro" href="" >XÓA</a>
                        <button type="button" href="" class="btn btn-danger" >KHÔNG</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>CKEDITOR.replace('editor1');</script>
@endsection

