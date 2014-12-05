<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Session', 'AutoComplete');
	var $components = array('Session', 'DebugKit.Toolbar');
	
	public function beforeFilter() {
		$locale = Configure::read('Config.language');
		if ($locale && file_exists(APP . 'View' . DS . $locale . DS . $this->viewPath)) {
			// e.g. use /app/View/fra/Pages/tos.ctp instead of /app/View/Pages/tos.ctp
			$this->viewPath = $locale . DS . $this->viewPath;
		}
	}

}
?>