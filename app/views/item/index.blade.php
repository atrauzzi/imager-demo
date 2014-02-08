@extends('main')

@section('title')
Items @parent
@stop

<h1>All Items</h1>

@section('content')

	@if($items->count())
		<p>
			<a href="{{ URL::route('item-create') }}">Add an item.</a>
		</p>
		@foreach($items as $item)
			@include('item/_tile', ['item' => $item])
		@endforeach
	@else
		<p>
			No items found.
			<a href="{{ URL::route('item-create') }}">Why don't you create one?</a>
		</p>
	@endif

@stop
