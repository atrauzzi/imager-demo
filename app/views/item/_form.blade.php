<script type="text/javascript">
$(function () {

	$('#gallery input').on('change', function (event) {

		var element = $(this);
		var container = element.parent();
		var parentContainer = container.parent();

		if(this.value) {
			var newFile = container.clone(true);
			parentContainer.append(newFile);
		}
		else if(parentContainer.children().length > 1) {
			container.remove();
		}

	});

});
</script>

<form action="{{ URL::route('item-store') }}" enctype="multipart/form-data" method="POST">

	<fieldset>

		<ul>
			<li>
				<label for="title">Title</label>
				<input type="text" name="title" id="title" value="{{ $itemData->get('title') }}" />
			</li>
			<li>
				<label for="slug">Slug</label>
				<input type="text" placeholder="(optional)" name="slug" id="slug" value="{{ $itemData->get('slug') }}" />
			</li>
		</ul>

	</fieldset>

	<fieldset>
		<h2>Files</h2>

		<h3>Preview</h3>
		<ul>
			<li>
				<input type="file" name="images[preview]"
			</li>
		</ul>

		<h3>Gallery</h3>
		<ul id="gallery">
			<li>
				<input type="file" name="images[]" />
			</li>
		</ul>

	</fieldset>

	<fieldset>
		<button type="submit">Save</button>
	</fieldset>

</form>