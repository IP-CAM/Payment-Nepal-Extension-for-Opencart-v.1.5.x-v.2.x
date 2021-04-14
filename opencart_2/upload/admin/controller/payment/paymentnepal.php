<?php

class ControllerPaymentPaymentnepal extends Controller {
	private $error = array();
	private $form;
	
  	public function index() {
		$this->load->language('payment/paymentnepal');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

    	if ($this->request->server['REQUEST_METHOD'] == 'POST') {
    		if ($this->validate($this->request->post)) {
				$this->model_setting_setting->editSetting('paymentnepal', $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
	
				$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
    		}
    	}

      	$data['breadcrumbs'] = $this->getBreadCrumbs();
		$data['lang'] = $this->language;

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		$data['_error'] = $this->error;
		
    	$data['action'] = $this->url->link('payment/paymentnepal', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$defaults = array(
			'paymentnepal_name' => '',
			'paymentnepal_callback' => '',
			'paymentnepal_success' => '',
			'paymentnepal_error' => '',
			'paymentnepal_secret' => '',
			'paymentnepal_key' => '',
			'paymentnepal_total' => '',
			'paymentnepal_order_status_id' => '',
			'paymentnepal_geo_zone_id' => '',
			'paymentnepal_status' => '',
			'paymentnepal_sort_order' => '',
		);
		foreach ($defaults as $key=>$value) {
			if (isset($this->request->post[$key])) {
				$defautls[$key] = $this->request->post[$key];
			}
			else {
				$defautls[$key] = $this->config->get($key);
			}
			$data[$key] = $defautls[$key];
			$data['entry_'.$key] = $this->language->get('entry_'.$key);
		}
    $data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
    $data['heading_title'] = $this->language->get('heading_title');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');		
		//$this->response->setOutput($this->render());	
    $this->response->setOutput($this->load->view('payment/paymentnepal.tpl', $data));
  	}

  	private function validate($post_data) {
		if (!$this->user->hasPermission('modify', 'payment/paymentnepal')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$post_data['paymentnepal_name']) {
			$this->error['warning'] = $this->language->get('error_form');
			$this->error['paymentnepal_name'] = $this->language->get('error_empty_field');
		}
		if (!$post_data['paymentnepal_secret']) {
			$this->error['warning'] = $this->language->get('error_form');
			$this->error['paymentnepal_secret'] = $this->language->get('error_empty_field');
		}
		if (!$post_data['paymentnepal_key']) {
			$this->error['warning'] = $this->language->get('error_form');
			$this->error['paymentnepal_key'] = $this->language->get('error_empty_field');
		}
		
    	if (!$this->error || !sizeof($this->error)) {
      		return true;
    	} else {
      		return false;
    	}
  	}
	
	private function getBreadCrumbs() {
		$breadcrumbs = array();

   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/paymentnepal', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
   		
      	return $breadcrumbs;
	}
}
?>
