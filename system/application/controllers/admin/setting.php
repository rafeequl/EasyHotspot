<?php

Class Setting extends Controller {
	
	function Setting (){
		parent::Controller();
		
		$this->freakauth_light->check('admin');
	}
	
	function index(){
		
	}
	
	

}