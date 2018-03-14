@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Category')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{--<strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>--}}
                    <b>Quản lý danh mục</b>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i> </a>
                </div><!--card-header-->
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $id => $title)
                                <tr>
                                    <th scope="row">{{ $id }}</th>
                                    <td>{{ $title }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.category.edit', $id) }}" class="btn btn-primary">
                                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.category.destroy', $id) }}"
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
                    </div>

                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
