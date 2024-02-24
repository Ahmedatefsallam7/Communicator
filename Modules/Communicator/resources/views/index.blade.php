@extends('communicator::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('communicator.name') !!}</p>
@endsection
