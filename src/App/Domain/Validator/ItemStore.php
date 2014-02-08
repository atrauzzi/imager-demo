<?php namespace App\Domain\Validator {


	use TippingCanoe\Validator\Base as Validator;

	class ItemStore extends Validator {

		protected $rules = [
			'title' => 'required|min:5',
			'slug' => 'unique:item'
		];

		protected $autoPopulate = true;

	}

}