@extends('main')

@section('title')
{{ $item->title }} @parent
@stop

<h1>{{ $item->title }}</h1>
<a href="/">Back to List</a>

@section('content')
	@include('item/_full', ['item' => $item])
@stop