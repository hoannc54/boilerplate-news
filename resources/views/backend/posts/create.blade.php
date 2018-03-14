@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Post')
@push('after-styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    @endpush
@push('after-scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 500
            });
        });
        $(document).ready(function() {
            $('#password').click(function () {
                $('#collapse-password').collapse()

            });
        });

    </script>
    @endpush
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    {{--<strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>--}}
                    Tạo bài viết mới
                </div><!--card-header-->
                <div class="card-block">
                    <form action="{{ route('admin.post.store') }}" method="post" id="form-post-create">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputCategory" name="title" placeholder="Tiêu đề bài viết">
                        </div>
                        <div class="form-group">

                            {{--<select class="js-example-basic-multiple" name="categories[]" multiple="multiple" style="width: 100%">--}}

                            {{--</select>--}}
                            {{--<select class="form-control" id="inputParent" name="category_id">--}}
                                {{--<option>--Chọn danh mục cho bài viết--</option>--}}
                                {{--@foreach($categories as $key => $title)--}}
                                    {{--<option value="{{ $key }}">{{ $title }}</option>--}}
                                {{--@endforeach--}}

                            {{--</select>--}}

                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="summernote" rows="5" name="content"></textarea>
                        </div>
                    </form>
                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    Đăng bài
                </div>
                <div class="card-block">
                    @foreach(\App\Models\Post::STATUS as $status => $name)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="{{ $status }}" value="{{ $status }}" form="form-post-create"
                               href="#password">
                        <label class="form-check-label" for="{{$status}}">
                            {{ $name }}
                        </label>
                    </div>
                    @endforeach
                        <div class="collapse" id="collapse-password">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                            </div>

                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary" form="form-post-create">Xem thử</button>
                    <button type="submit" class="btn btn-primary float-right" form="form-post-create">Đăng bài</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Danh mục
                </div>
                <div class="card-block">
                    <select id="multiple-select" name="categories[]" class="form-control" size="5" multiple="" form="form-post-create">
                        @foreach($categories as $key => $title)
                            <option value="{{ $key }}">{{ $title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div><!--row-->
@endsection
