<?php

class AuthController extends \BaseController {

	public function login()
    {
        return View::make('auth/login');
    }


}