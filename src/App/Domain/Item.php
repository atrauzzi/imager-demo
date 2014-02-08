<?php namespace App\Domain {

	use Illuminate\Database\Eloquent\Builder;
	use Illuminate\Database\Eloquent\Model;
	use TippingCanoe\Imager\Model\Imageable;
	use TippingCanoe\Imager\Model\ImageableImpl;


	class Item extends Model implements Imageable {

		use ImageableImpl;

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