@extends('frontend.layouts.app')

@section('title', app_name() . ' | '.__('navs.general.home'))

@section('content')
    <div>
        <h1>{{ $post->title }}</h1>
    </div>
    <div>
        {!! $post->content !!}
    </div>
@endsection
