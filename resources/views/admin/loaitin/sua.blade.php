@extends('admin.layout.index')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại tin
                            <small>{{ $loaitin->Ten }}</small>
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
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tên loại tin</label>
                                <input class="form-control" name="Ten" value="{{ $loaitin->Ten }}"  />
                            </div>
                            <div class="form-group">
                                    <label>Thể loại</label>
                                    <select class="form-control" name="idTheLoai">
                                        @foreach ($theloai as $tl)
                                            <option  
                                                @if ($loaitin->idTheLoai == $tl->id)
                                                    {{ "Selected" }}
                                                @endif
                                            value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                            <button type="submit" class="btn btn-default">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection