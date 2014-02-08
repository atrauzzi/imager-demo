<?php namespace App\Domain\Repository {

	use App\Domain\Repository\Item as ItemRepository;
	use App\Domain\Item as ItemModel;


	class DbItem implements ItemRepository {

		/**
		 * @return \Illuminate\Database\Eloquent\Collection
		 */
		public function all() {
			return ItemModel::orderBy('created_at', 'DESC')->get();
		}

		/**
		 * @param string $slug
		 * @return \App\Domain\Item
		 */
		public function findBySlug($slug) {
			return ItemModel::withSlug($slug)->first();
		}

		/**
		 * @param string $slug
		 * @return \App\Domain\Item
		 */
		public function findLastSlug($slug) {
			return ItemModel
				::slugLike($slug)
				->orderBy('slug', 'DESC')
				->first()
			;
		}

		/**
		 * @param array $attributes
		 * @return \App\Domain\Item
		 */
		public function store($attributes) {
			return ItemModel::create($attributes);
		}

	}

}