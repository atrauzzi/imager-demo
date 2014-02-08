@extends('main')

@section('title')
	Create Item @parent
@stop

<h1>Create an Item</h1>

@section('content')
	@include('item/_form', ['itemData' => $itemData])
@stop