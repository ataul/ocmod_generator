<?php
class ControllerExtensionModuleOCMODGenerator extends Controller {
	private $error = array();
	public function index() {		
		$this->load->language('extension/module/OCMOD_Generator');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('OCMOD_Generator', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_edit'] = $this->language->get('text_edit');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link(
                'common/home', 'user_token=' . $this->session->data['user_token'], 'SSL'
            ),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link(
				'marketplace/extension', 'user_token=' . $this->session->data['user_token'], 'SSL'
			),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link(
				'extension/module/OCMOD_Generator', 'user_token=' . $this->session->data['user_token'], 'SSL'
			),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link(
			'extension/module/OCMOD_Generator', 
			'user_token=' . $this->session->data['user_token'], 
			'SSL'
		);
		
		$data['cancel'] = $this->url->link(
			'extension/module/OCMOD_Generator', 'user_token=' . $this->session->data['user_token'], 'SSL'
		);

		// if (isset($this->request->post['OCMOD_Generator'])) {
		// 	$modules = explode(',', $this->request->post['OCMOD_Generator']);
		// } elseif ($this->config->get('OCMOD_Generator') != '') { 
		// 	$modules = explode(',', $this->config->get('OCMOD_Generator'));
		// } else {
		// 	$modules = array();
		// }		
		
		//$this->load->model('design/layout');
		
		//$data['layouts'] = $this->model_design_layout->getLayouts();

		//$data['modules'] = $modules;
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}
		
		// if (isset($this->request->post['OCMOD_Generator'])) {
		// 	$data['OCMOD_Generator'] = $this->request->post['OCMOD_Generator'];
		// } else {
		// 	$data['OCMOD_Generator'] = $this->config->get('OCMOD_Generator');
		// }

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/OCMOD_Generator', $data));		
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/OCMOD_Generator')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	public function install() { 
			
	}
	
	public function uninstall() {  
	}

	public function delete() { 
		
    }
}	