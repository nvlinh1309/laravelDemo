@extends('admin.layout.index')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{ $tintuc->TieuDe }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if (count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>                            
                            @endif
                            @if (session('thongbao'))
                                <div class="alert alert-success">
                                    {{ session('thongbao') }}
                                </div>
                    @endif
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" id="TheLoai" name="idTheLoai">
                                    @foreach ($theloai as $tl)
                                        <option 
                                            @if ($tintuc->loaitin->theloai->id==$tl->id)
                                                {{ "selected" }}
                                            @endif
                                        value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                    <label>Loại tin</label>
                                    <select class="form-control" id="LoaiTin" name="idLoaiTin">
                                        @foreach ($loaitin as $lt)
                                            <option
                                            @if ($tintuc->idLoaiTin==$lt->id)
                                                {{ "selected" }}
                                            @endif
                                            value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" value="{{ $tintuc->TieuDe }}" name="TieuDe" placeholder="Nhập tiêu đề..." />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control" name="TomTat" rows="3" placeholder="Nhập tóm tắt...">{{ $tintuc->TomTat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="form-control ckeditor" name="NoiDung">{{ $tintuc->NoiDung }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img src="upload/tintuc/{{ $tintuc->Hinh }}" width="400px"></p>
                                <input type="file" class="form-control" name="Hinh"/>
                            </div>
                            <div class="form-group">
                                    <label>Nổi bật</label>
                                    <label class="radio-inline">
                                        <input 
                                        @if ($tintuc->NoiBat==0)
                                            {{ 'checked' }}
                                        @endif
                                        name="NoiBat" value="0"  type="radio">Không
                                    </label>
                                    <label class="radio-inline">
                                        <input 
                                        @if ($tintuc->NoiBat==1)
                                            {{ 'checked' }}
                                        @endif
                                        name="NoiBat" value="1" type="radio">Có
                                    </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình luận
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead> 
                            <tr align="center">
                                <th>ID</th>
                                <th style="width: 20%">Người dùng</th>
                                <th style="width: 50%">Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                    <td>{{ $cm->id }}</td>
                                    <td>{{ $cm->user->name }}</td>
                                    <td>{{ $cm->NoiDung }}</td>
                                    <td>{{ $cm->created_at }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}"> Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            {{-- endrow --}}
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        {{-- Danh sách comment --}}
        
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#TheLoai').change(function(){
                var idTheLoai=$(this).val();
                // alert (idTheLoai);
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $('#LoaiTin').html(data);
                });
            });
        });    
    </script>
@endsection