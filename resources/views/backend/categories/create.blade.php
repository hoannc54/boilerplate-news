@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Category')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{--<strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>--}}
                    Tạo danh mục mới
                </div><!--card-header-->
                <div class="card-block">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Danh mục</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCategory" name="title" placeholder="Tên danh mục">
                                <i>Tên riêng sẽ hiển thị trên trang của bạn.</i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Slug</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCategory" name="slug" placeholder="Slug">
                                <i>Chuỗi cho đường dẫn tĩnh là phiên bản của tên hợp chuẩn với Đường dẫn (URL). Chuỗi này bao gồm chữ cái thường, số và dấu gạch ngang (-).</i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputParent" class="col-sm-2 col-form-label">Danh mục cha</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="inputParent" name="parent_id">
                                    @foreach($categories as $key => $title)
                                        <option value="{{ $key }}">{{ $title }}</option>
                                        @endforeach

                                </select>
                                <i>Chuyên mục khác với thẻ, bạn có thể sử dụng nhiều cấp chuyên mục.</i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" rows="5"></textarea>
                                <i>Thông thường mô tả này không được sử dụng trong các giao diện, tuy nhiên có vài giao diện có thể hiển thị mô tả này.</i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
