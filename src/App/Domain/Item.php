<?php namespace App\Domain {

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Builder;
	use TippingCanoe\Imager\Model\Imageable;
	use TippingCanoe\Imager\Model\ImageableImpl;
	use Atrauzzi\LaravelNestedSet\NestedSet;
	use Atrauzzi\LaravelNestedSet\NestedSetImpl;


	class Item extends Model implements Imageable, NestedSet {

		use ImageableImpl;
		use NestedSetImpl;


		protected $table = "item";

		protected $fillable = [
			'title',
			'slug'
		];

		public function scopeWithSlug(Builder $query, $slug) {
			return $query->where('slug', $slug);
		}

		public function scopeSlugLike(Builder $query, $slug) {
			return $query->where('slug', 'LIKE', sprintf('%%%s%%', $slug));
		}

	}

}