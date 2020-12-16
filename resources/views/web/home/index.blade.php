@extends('layouts.web.app')

@section('site-title', 'ekino - internetowa wypożyczalnia filmów')

@section('content')
    @if($slides->isNotEmpty())
        @include('web.home.components.slider.slider', [
            'slides' => $slides
        ])
    @endif
@endsection
