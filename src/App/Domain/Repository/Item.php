<?php namespace App\Domain\Repository {

	interface Item {

		/**
		 * @return \Illuminate\Database\Eloquent\Collection
		 */
		public function all();

		/**
		 * @param string $slug
		 * @return \App\Domain\Item
		 */
		public function findBySlug($slug);

		/**
		 * @param string $slug
		 * @return \App\Domain\Item
		 */
		public function findLastSlug($slug);

		/**
		 * @param array $attributes
		 * @return \App\Domain\Item
		 */
		public function store($attributes);

	}

}