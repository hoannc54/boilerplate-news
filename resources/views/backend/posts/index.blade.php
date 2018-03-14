@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Category')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{--<strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>--}}
                    Danh sách bài viết
                    <a href="{{ route('admin.post.create') }}" class="btn btn-success float-right">
                        <i class="fa fa-plus-circle"></i>
                    </a>
                </div><!--card-header-->
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Trạng thái</th>
                            <th>Tác giả</th>
                            <th>Tạo</th>
                            <th>Cập nhật</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $id => $post)
                            <tr>
                                <th scope="row">1</th>
                                <td><a href="{{ route('admin.post.show', $post->id) }}">{{ $post->title }}</a> </td>
                                <td>{{ array_get(\App\Models\Post::STATUS, $post->status, 'Chưa xác định') }}</td>
                                <td>{{ $post->user->first_name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-primary">
                                            <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                        </a>
                                        <a href="{{ route('admin.post.destroy', $post->id) }}"
                                           data-method="delete"
                                           data-trans-button-cancel="Cancel"
                                           data-trans-button-confirm="Delete"
                                           data-trans-title="Bạn có chắc chắn muốn xoá không ?"
                                           class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
