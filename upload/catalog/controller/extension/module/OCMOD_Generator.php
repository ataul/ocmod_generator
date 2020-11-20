<?php
class ControllerExtensionModuleOCMODGenerator extends Controller {
	public function index($setting) {
		$data = array();
		$this->load->language('extension/module/OCMOD_Generator');
		
		//Add your code here

		return $this->load->view('extension/module/OCMOD_Generator', $data);
	}
}