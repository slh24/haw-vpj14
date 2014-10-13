<?php

namespace VPJ14\Form;

use Zend\Form\Form;

class AuftragStateForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('auftrag');

		$this->add(array(
				'name' => 'id',
				'type' => 'Text',
				'options' => array(
						'label' => 'Auftrags-ID',
						'label_attributes' => array(
								'class' => 'sr-only',
						),
				),
				'attributes' => array(
						'id' => 'id',
						'class' => 'form-control',
						'placeholder' => 'Auftrags-ID',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Prüfen',
						'id' => 'submitbutton',
						'class' => 'btn btn-success',
				),
		));
	}
}
