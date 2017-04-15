<?php
/**
 * Módulo Frete Personalizado
 * Catalog/Model
 * @since 19/12/2016
 */
class ModelExtensionShippingPersonalizado extends Model {
	function getQuote($address) {
		$this->load->language('extension/shipping/personalizado');
		
		$status = false;
		$title = $this->config->get('personalizado_titulo');
		$quote_data = array();

		$personalizado_fretes = $this->config->get('personalizado_fretes');

		if (is_array($personalizado_fretes)) {
			foreach ($personalizado_fretes as $i => $frete) {

				if ($frete['cepInicial'] || $frete['cepFinal']) {
					$min = (int)preg_replace ("/[^0-9]/", '', $frete['cepInicial']);
					$max = (int)preg_replace ("/[^0-9]/", '', $frete['cepFinal']);

					if (!$max) {
						$max = 99999999;
					}

					$cep = (int)preg_replace ("/[^0-9]/", '', $address['postcode']);

					$valorStatus = true;
					$total = $this->cart->getSubTotal();
					if ($frete['valor_min'] !== '' ) {
						$valorStatus = ($total >= (float)$frete['valor_min']);
					}
					if ($frete['valor_max'] !== '') {
						$valorStatus = $valorStatus && ($total <= (float)$frete['valor_max']);
					}

					if ($cep && $cep >= $min && $cep <= $max && $valorStatus) {
						$status = true;
						$quote_data[$i] = array(
							'code'         => 'personalizado.' . $i,
							'title'        => $frete['nome'],
							'cost'         => $frete['valor'],
							'tax_class_id' => 0,
							'text'         => $this->currency->format($frete['valor'], $this->session->data['currency'])
						);
					} else {
						$status = false;
					}
				} else {
					$status = true;
				}
			}
		}
		
		if ($quote_data) $status = true;

		$method_data = array();

		if ($status) {

			$method_data = array(
				'code'       => 'personalizado',
				'title'      => ($title) ? $title : $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('personalizado_sort_order'),
				'error'      => false
			);
		}

		return $method_data;
	}
}
