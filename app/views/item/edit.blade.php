@extends('main')

@section('title')
	Editing {{ $itemData->get('title') }} @parent
@stop

<h1>Editing {{ $itemData->get('title') }}</h1>

@section('content')
@include('item/_form', ['itemData' => $itemData])
@stop