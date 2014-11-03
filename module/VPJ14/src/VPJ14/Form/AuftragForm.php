<?php

namespace VPJ14\Form;

use Zend\Form\Form;

class AuftragForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('auftrag');

		for ($i = 1; $i <= 4; $i++) {
			$this->add(array(
					'name' => 'schritt_'. $i .'_maschine',
					'type' => 'Select',
					'options' => array(
							'label' => 'Schritt '. $i,
							'label_attributes' => array(
									'class' => 'col-sm-2 control-label',
							),
							'value_options' => array(
									'' => 'Keine Maschine',
									'1' => 'Maschine 1',
									'2' => 'Maschine 2',
									'3' => 'Maschine 3',
									'4' => 'Maschine 4',
							)
					),
					'attributes' => array(
							'id' => 'schritt_'. $i .'_maschine',
							'class' => 'form-control',
					),
			));
			$this->add(array(
					'name' => 'schritt_'. $i .'_dauer',
					'type' => 'Text',
					'attributes' => array(
							'id' => 'schritt_'. $i .'_dauer',
							'class' => 'form-control',
							'placeholder' => 'Bearbeitungsdauer [s]',
					),
			));
		}
		
		$this->add(array(
				'name' => 'anz_soll',
				'type' => 'Text',
				'options' => array(
						'label' => 'Anzahl',
						'label_attributes' => array(
								'class' => 'col-sm-2 control-label',
						),
				),
				'attributes' => array(
						'id' => 'anz_soll',
						'class' => 'form-control',
						'placeholder' => 'Anzahl',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
						'class' => 'btn btn-primary',
				),
		));
	}
}
