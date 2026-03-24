@extends('layouts.app')

@section('sidebar')
@include('components.sidebar', ['role' => 'admin'])
@endsection