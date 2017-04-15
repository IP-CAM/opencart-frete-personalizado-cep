<?php
/**
 * Módulo Frete Personalizado
 * OpenCart 2.3
 * Admin/Controller
 * @since 19/12/2016
 */
class ControllerExtensionShippingPersonalizado extends Controller {
	private $error = array(); 

	public function index() {   
		$this->load->language('extension/shipping/personalizado');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('personalizado', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_titulo'] = $this->language->get('entry_titulo');
		$data['entry_cost'] = $this->language->get('entry_cost');
		$data['entry_nome'] = $this->language->get('entry_nome');
		$data['entry_prazo'] = $this->language->get('entry_prazo');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/personalizado', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/personalizado', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true);

		if (isset($this->request->post['personalizado_titulo'])) {
			$data['personalizado_titulo'] = $this->request->post['personalizado_titulo'];
		} else {
			$data['personalizado_titulo'] = $this->config->get('personalizado_titulo');
		}

		if (isset($this->request->post['personalizado_fretes'])) {
			$data['personalizado_fretes'] = $this->request->post['personalizado_fretes'];
		} else {
			$data['personalizado_fretes'] = $this->config->get('personalizado_fretes');
		}

		if (!is_array($data['personalizado_fretes'])) {
			$data['personalizado_fretes'] = array();
		}

		if (isset($this->request->post['personalizado_status'])) {
			$data['personalizado_status'] = $this->request->post['personalizado_status'];
		} else {
			$data['personalizado_status'] = $this->config->get('personalizado_status');
		}

		if (isset($this->request->post['personalizado_sort_order'])) {
			$data['personalizado_sort_order'] = $this->request->post['personalizado_sort_order'];
		} else {
			$data['personalizado_sort_order'] = $this->config->get('personalizado_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/shipping/personalizado', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/personalizado')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}