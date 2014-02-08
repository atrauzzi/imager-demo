<?php namespace App\ErrorHandler;

use Exception;


interface Base {

	public function handle(Exception $ex);

}