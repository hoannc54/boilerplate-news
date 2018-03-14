@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Category')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{--<strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>--}}
                    Chi tiết bài viết: <b>{!! $post->title !!}</b>
                </div><!--card-header-->
                <div class="card-block">
                    <div>
                        {!! $post->content !!}
                    </div>
                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
