<?php return [

	// Here's a sample image filter for you to use.  Create as many as your project requires!
	'item_full' => [

		'TippingCanoe\Imager\Processing\FixRotation',

		[
			'TippingCanoe\Imager\Processing\Resize',
			[
				'width' => 450,
				'height' => 300,
				'preserve_ratio' => true
			]
		],

	],

	'item_thumbnail' => [

		'TippingCanoe\Imager\Processing\FixRotation',

		[
			'TippingCanoe\Imager\Processing\Resize',
			[
				'width' => 135,
				'height' => 135,
				'preserve_ratio' => true
			]
		],
	]

];