@extends('layouts.frontLayout.front_base')

@section('header')
@include('layouts.frontLayout.front_header')
@endsection


@section('content')
@yield('content');   
@endsection


@section('footer')
@include('layouts.frontLayout.front_footer')
@endsection


