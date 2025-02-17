@extends('backend.layouts.backend-master')
@section('backend-main')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Trang chủ</a></li>
    <li><a href="#">Sản phẩm</a></li>
    <li class="active">Thêm sản phẩm</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{route('admin.post.create.product')}}">
                @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Thêm</strong> sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Danh mục</label>
                                    <div class="col-md-9">
                                        <select class="form-control select" name="pro_cate_id" id="">
                                            <option value="">Chọn thương hiệu</option>
                                            @if(isset($categories))
                                            @foreach($categories as $category )
                                            <option value="{{$category->id}} 
                                                {{ old('pro_cate_id',isset($product->pro_cate_id) ? $product->pro_cate_id : '')== $category->id ? "selected='selected'":"" }}">
                                                {{$category->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('pro_cate_id'))
                                            <div class="help-block">
                                                {{ $errors->first('pro_cate_id') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Loại</label>
                                        <div class="col-md-9">
                                            <?php $productType = DB::table('product_type')->get();
                                            ?>
                                            <select class="form-control select" name="pro_type">
                                                <option>Vui lòng chọn loại laptop</option>
                                                @foreach ($productType as $pro_type)
                                                <option value="{{$pro_type->id}}">{{ucwords($pro_type -> name)}}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tên sản phẩm</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="pro_name" />
                                            </div>
                                            @if($errors->has('pro_name'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_name')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Giá</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-dollar"></span></span>
                                                <input type="text" class="form-control" name="pro_price" />
                                            </div>
                                            @if($errors->has('pro_price'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_price')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Giảm Giá %</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class=""></span></span>
                                                <input type="text" class="form-control" name="pro_sale" />
                                            </div>
                                            @if($errors->has('pro_sale'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_sale')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Số Lượng</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="pro_amount" />
                                            </div>
                                            @if($errors->has('pro_amount'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_amount')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mô tả</label>
                                        <div class="col-md-9 col-xs-12">
                                            <textarea class="form-control" rows="5" name="pro_content"></textarea>
                                            @if($errors->has('pro_content'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_content')!!}
                                            </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Hình ảnh</label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div style="text-align: center;">
                                                            <input type="file" class="fileinput btn-primary" name="pro_image" id="filename" title="Chọn hình chính" />
                                                            @if($errors->has('pro_image'))
                                                            <div class="help-block">
                                                                {!!$errors->first('pro_image')!!}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <img id="img_upload" class="img img-responsive" src="" alt="">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div style="text-align: center;">
                                                            <input type="file" class="fileinput btn-primary" name="image1" id="filename2" title="Chọn hình ảnh 2" />
                                                            @if($errors->has('image1'))
                                                            <div class="help-block">
                                                                {!!$errors->first('image1')!!}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <img id="img_upload2" class="img img-responsive" src="" alt="">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>

                                        <div class="col-md-9">
                                            <div class="col-md-6">
                                                <div style="text-align: center;">
                                                    <input type="file" class="fileinput btn-primary" name="image2" id="filename3" title="Chọn hình ảnh 3" />
                                                    @if($errors->has('image2'))
                                                    <div class="help-block">
                                                        {!!$errors->first('image2')!!}
                                                    </div>
                                                    @endif
                                                </div>
                                                <img id="img_upload3" class="img img-responsive" src="" alt="">

                                            </div>
                                            <div class="col-md-6">
                                                <div style="text-align: center;">

                                                    <input type="file" class="fileinput btn-primary" name="image3" id="filename4" title="Chọn hình ảnh 4" />
                                                    @if($errors->has('image3'))
                                                    <div class="help-block">
                                                        {!!$errors->first('image3')!!}
                                                    </div>
                                                    @endif
                                                </div>
                                                <img id="img_upload4" class="img img-responsive" src="" alt="">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Bộ xử lý CPU</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="cpu" />

                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Bộ nhớ RAM</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="ram" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Màn hình</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="screen" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Card màn hình</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="card" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ổ cứng</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="harddrive" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kích thước và trọng lượng</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="weight" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Camera</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="camera" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Cổng kết nối</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="port" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pin</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                <input type="text" class="form-control" name="pin" />
                                            </div>
                                            @if($errors->has('pro_detail'))
                                            <div class="help-block">
                                                {!!$errors->first('pro_detail')!!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            {{-- <button class="btn btn-default">Xóa trường</button> --}}
                            <button type="submit" class="btn btn-primary pull-right">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
    @stop