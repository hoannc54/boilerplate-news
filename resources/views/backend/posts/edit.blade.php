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
            var content = '{!! $post->content !!}';
            console.log(content);
            $('#inputDescription').summernote('code', content);
        });
        $(document).ready(function() {
            $('#password').click(function () {
                $('#collapse-password').collapse()

            });
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
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
                    <form action="{{ route('admin.post.update', $post->id) }}" method="post" id="form-post-create" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" placeholder="Tiêu đề bài viết">
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
                            <textarea class="form-control" id="inputDescription" rows="5" name="content"></textarea>
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
                    <div>
                        <label><b><i class="fa fa-map-pin"></i> Trạng thái</b></label>
                        @foreach(\App\Models\Post::STATUS as $status => $name)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="{{ $status }}" value="{{ $status }}"
                                       form="form-post-create" @if($status == $post->status) checked @endif>
                                <label class="form-check-label" for="{{$status}}">
                                    {{ $name }}
                                </label>
                            </div>
                        @endforeach
                        <div class="collapse" id="collapse-password">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" form="form-post-create">
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div>
                        <label><b><i class="fa fa-eye"></i> Chế độ xem</b></label>
                        @foreach(\App\Models\Post::VISIBILITY as $status => $name)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="visibility" id="{{ $status }}" value="{{ $status }}" form="form-post-create"
                                       @if($status == $post->visibility) checked @endif>
                                <label class="form-check-label" for="{{$status}}">
                                    {{ $name }}
                                </label>
                            </div>
                        @endforeach
                        <div class="collapse" id="collapse-password">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" form="form-post-create">
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div>
                        <b><i class="fa fa-clock-o"></i> Thời gian: </b><i>{{ $post->date }}</i><a data-toggle="collapse" href="#collapseDate" aria-expanded="false" aria-controls="collapseExample">
                            Sửa
                        </a>
                    </div>
                        <div class="collapse" id="collapseDate">
                            <div class="form-group">
                                <input type="datetime-local" class="form-control" name="date" form="form-post-create">
                            </div>

                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary" form="form-post-create">Xem thử</button>
                    <button type="submit" class="btn btn-primary float-right" form="form-post-create">Cập nhật</button>
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
            <div class="card">
                <div class="card-header">
                    Ảnh đại diện
                </div>
                <div class="card-block">
                    <img id="blah" src="{{ url($post->img_path) }}" alt="your image" width="100%" style="margin-bottom: 20px">

                    <input type='file' id="imgInp" name="image" form="form-post-create"/>

                </div>
            </div>
        </div>
    </div><!--row-->
@endsection
