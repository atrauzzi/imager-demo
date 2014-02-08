@if($galleryImages->count())
<ul>
@foreach($galleryImages as $image)
	<li>
		<img src="{{ Imager::getPublicUri($image, Config::get('imager::filters.item_full')) }}" />
	</li>
@endforeach
</ul>
@else
<p>
	This item has no images!
	<!-- <a href="{{ URL::route('item-edit', ['slug' => $item->slug]) }}">Add some!</a> -->
</p>
@endif