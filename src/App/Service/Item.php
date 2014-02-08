<?php namespace App\Service {

	use \App\Domain\Repository\Item as ItemRepository;
	use Illuminate\Support\Str;


	class Item {

		protected $itemRepository;

		public function __construct(
			ItemRepository $itemRepository
		) {
			$this->itemRepository = $itemRepository;
		}

		public function store($attributes) {

			// Easy to know when we have to generate a slug.
			if(empty($attributes['slug']))
				$attributes['slug'] = Str::slug($attributes['title']);

			// Quick and dirty slug dupe check.
			if($duplicateSlug = $this->itemRepository->findLastSlug($attributes['slug'])) {
				$lastChar = substr($duplicateSlug->slug, -1, 1);
				$attributes['slug'] .= is_numeric($lastChar) ? $lastChar + 1 : '1';
			}

			return $this->itemRepository->store($attributes);

		}

	}

}