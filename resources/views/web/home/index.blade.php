@extends('layouts.web.app')

@section('site-title', 'ekino - internetowa wypożyczalnia filmów')

@section('content')
    @include('web.home.components.slider.slider', [
        'slides' => $cinematographies->random(3)
    ])
@endsection
