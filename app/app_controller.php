<?php
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	
	public function beforeFilter() {
		$locale = Configure::read('Config.language');
		if ($locale && file_exists(VIEWS . $locale . DS . $this->viewPath)) {
			// e.g. use /app/View/fra/Pages/tos.ctp instead of /app/View/Pages/tos.ctp
			$this->viewPath = $locale . DS . $this->viewPath;
		}
	}

}
?>