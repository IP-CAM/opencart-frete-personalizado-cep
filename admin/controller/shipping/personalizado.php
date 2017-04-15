<?php
/*
	Módulo Frete Personalizado
	Admin/Controller
	Criado por Marlon em 06/05/2014
*/
class ControllerShippingPersonalizado extends Controller {
	private $error = array(); 

	public function index() {   
		$this->language->load('shipping/personalizado');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('personalizado', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');

		$this->data['entry_titulo'] = $this->language->get('entry_titulo');
		$this->data['entry_cost'] = $this->language->get('entry_cost');
		$this->data['entry_nome'] = $this->language->get('entry_nome');
		$this->data['entry_prazo'] = $this->language->get('entry_prazo');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add'] = $this->language->get('button_add');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/personalizado', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('shipping/personalizado', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['personalizado_titulo'])) {
			$this->data['personalizado_titulo'] = $this->request->post['personalizado_titulo'];
		} else {
			$this->data['personalizado_titulo'] = $this->config->get('personalizado_titulo');
		}

		if (isset($this->request->post['personalizado_fretes'])) {
			$this->data['personalizado_fretes'] = $this->request->post['personalizado_fretes'];
		} else {
			$this->data['personalizado_fretes'] = $this->config->get('personalizado_fretes');
		}

		if (!is_array($this->data['personalizado_fretes'])) {
			$this->data['personalizado_fretes'] = array();
		}

		if (isset($this->request->post['personalizado_status'])) {
			$this->data['personalizado_status'] = $this->request->post['personalizado_status'];
		} else {
			$this->data['personalizado_status'] = $this->config->get('personalizado_status');
		}

		if (isset($this->request->post['personalizado_sort_order'])) {
			$this->data['personalizado_sort_order'] = $this->request->post['personalizado_sort_order'];
		} else {
			$this->data['personalizado_sort_order'] = $this->config->get('personalizado_sort_order');
		}

		$this->template = 'shipping/personalizado.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/personalizado')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>