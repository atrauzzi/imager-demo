<?php namespace App\Controller {

	use Illuminate\Http\RedirectResponse;
	use Illuminate\Routing\Controller;
	use Illuminate\View\Environment as ViewEnvironment;
	use Illuminate\Routing\UrlGenerator;
	use App\Domain\Repository\Item as ItemRepository;
	use App\Service\Item as ItemService;
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
	use App\Domain\Validator\ItemStore as ItemStoreValidator;
	use TippingCanoe\Imager\Service as Imager;


	class Item extends Controller {

		/** @var \Illuminate\View\Environment */
		protected $view;

		/** @var \Illuminate\Routing\UrlGenerator */
		protected $url;

		/** @var \App\Domain\Repository\Item */
		protected $itemRepository;

		/** @var \App\Service\Item */
		protected $itemService;

		/** @var \TippingCanoe\Imager\Service */
		protected $imager;

		public function __construct(
			ViewEnvironment $view,
			UrlGenerator $url,
			ItemRepository $itemRepository,
			ItemService $itemService,
			Imager $imager
		) {
			$this->view = $view;
			$this->url = $url;
			$this->itemRepository = $itemRepository;
			$this->itemService = $itemService;
			$this->imager = $imager;
		}

		/**
		 * @return \Illuminate\View\View
		 */
		public function index() {
			return $this->view->make('item/index', ['items' => $this->itemRepository->all()]);
		}

		/**
		 * @return \Illuminate\View\View
		 */
		public function create() {
			// Pass in a dummy validator, see the store() method for more details.
			return $this->view->make('item/create', ['itemData' => new ItemStoreValidator()]);
		}

		/**
		 * @return RedirectResponse|\Illuminate\View\View
		 */
		public function store() {

			// If the data is invalid, re-run the form, supplying it with the validator.
			$itemStore = new ItemStoreValidator();
			if(!$itemStore->valid())
				// Using the validator cuts away excessive checking in the template via the get() method.
				return $this->view->make('item/create', ['itemData' => $itemStore]);

			// Otherwise, save the item via the service.
			$item = $this->itemService->store($itemStore->values);

			$files = $itemStore->files();
			foreach($files['images'] as $slot => $file)
				if($file)
					$this->imager->saveFromFile($file, $item, ['slot' => $slot]);

			// Redirect so that the URL reflects the creation.
			return new RedirectResponse($this->url->route('item-show', ['slug' => $item->slug]));

		}

		/**
		 * @param string $slug
		 * @return \Illuminate\View\View
		 */
		public function show($slug) {

			$item = $this->getItemBySlug($slug);

			return $this->view->make('item/show', [
				'item' => $item,
				'galleryImages' => $item->images()->inIntegerSlot()->get()
			]);

		}

		/**
		 * @param string $slug
		 * @return \Illuminate\View\View
		 */
		public function edit($slug) {

			$item = $this->getItemBySlug($slug);

			return $this->view->make('item/edit', [
				'itemData' => new ItemStoreValidator($item->toArray())
			]);

		}

		//
		//
		//

		/**
		 * @param string $slug
		 * @return \App\Domain\Item
		 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
		 */
		public function getItemBySlug($slug) {
			if(!$item = $this->itemRepository->findBySlug($slug))
				throw new NotFoundHttpException('Item not found.');
			return $item;
		}

	}

}