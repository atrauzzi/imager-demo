<h3>{{ $item->title }}</h3>
@if($image = $item->images()->inSlot('preview')->first())
<img src="{{ Imager::getPublicUri($image, Config::get('imager::filters.item_thumbnail')) }}" />
@else
<span>No image!</span>
@endif