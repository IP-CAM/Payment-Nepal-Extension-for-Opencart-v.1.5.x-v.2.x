<?php

class ControllerPaymentPAYMENTNEPAL extends Controller {
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
	
				$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
    		}
    	}

      	$this->data['breadcrumbs'] = $this->getBreadCrumbs();
		$this->data['lang'] = $this->language;

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		$this->data['_error'] = $this->error;
		
    	$this->data['action'] = $this->url->link('payment/paymentnepal', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
    $this->data['pay_types'] = array( 0 => array('name' => 'Payment select','cod' =>'0'),1 => array('name' => 'card','cod' =>'spg'));

		$defaults = array(
			'paymentnepal_name' => '',
			'paymentnepal_callback' => '',
			'paymentnepal_success' => '',
			'paymentnepal_error' => '',
			'paymentnepal_secret' => '',
			'paymentnepal_key' => '',
			'paymentnepal_total' => '',
			'paymentnepal_commission' => '',
      		'paymentnepal_payment_type' => '',
			'paymentnepal_payment_spg' => '',
			'paymentnepal_payment_wm' => '',
			'paymentnepal_payment_ym' => '',
			'paymentnepal_payment_mc' => '',
			'paymentnepal_payment_qiwi' => '',
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
			$this->data[$key] = $defautls[$key];
			$this->data['entry_'.$key] = $this->language->get('entry_'.$key);
		}

		$this->template = 'payment/paymentnepal.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());	
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
