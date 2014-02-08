<?php namespace App\ErrorHandler;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Translation\Translator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use TippingCanoe\Validator\Exception as ValidationException;


class Json implements Base {

	/** @var \Illuminate\Translation\Translator */
	protected $translator;

	/** @var bool */
	protected $debug;

	public function __construct(Translator $translator, $debug = false) {
		$this->translator = $translator;
		$this->debug = $debug;
	}

	public function handle(Exception $ex) {

		// Default Error Data
		$data = [
			'type' => 'error'
		];
		$headers = [];
		$key = 'messages.error_encountered';
		$code = 500;

		// If we're capturing an HttpException, recycle it!
		if($ex instanceof HttpException) {

			$headers = $ex->getHeaders();
			$code = $ex->getStatusCode();

			switch ($code) {

				case 400:
					$key = 'messages.invalid';
				break;

				case 401:
					$key = 'messages.unauthenticated';
				break;

				case 403:
					$key = 'messages.access_denied';
				break;

				case 404:
					$key = 'messages.not_found';
				break;

				case 409:
					$key = 'messages.not_allowed';
				break;

				case 405:
					$key = 'messages.unsupported_method';
				break;

			}

		}
		elseif($ex instanceof ValidationException) {
			$code = 400;
			$data['errors'] = $ex->getMessages();
			$key = 'messages.validation';
		}

		// When fatal in debug environments, include full stack trace.
		if($code == 500	&& $this->debug) {
			$data['_line'] = $ex->getLine();
			$data['_file'] = $ex->getFile();
			$data['_trace'] = $ex->getTrace();
			$data['_type'] = get_class($ex);
			$data['_message'] = $ex->getMessage();
		}

		$data['message'] = $this->translator->trans($key);
		$data['key'] = $key;

		// Significant data first.
		ksort($data);
		$data = array_reverse($data);

		return new JsonResponse($data, $code, $headers);

	}

}