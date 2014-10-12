<?php
class DoctorController extends BaseController {
	
	function index()
	{
		return View::make('doctor/index');
	}
}