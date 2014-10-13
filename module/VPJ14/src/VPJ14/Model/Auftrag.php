<?php

namespace VPJ14\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Auftrag implements InputFilterAwareInterface
{
	public $schritt_1_maschine;
	public $schritt_1_dauer;
	public $schritt_2_maschine;
	public $schritt_2_dauer;
	public $schritt_3_maschine;
	public $schritt_3_dauer;
	public $schritt_4_maschine;
	public $schritt_4_dauer;
	public $anz_soll;
	public $anz_ist;
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->schritt_1_maschine = (!empty($data['schritt_1_maschine'])) ? $data['schritt_1_maschine'] : null;
		$this->schritt_1_dauer = (!empty($data['schritt_1_dauer'])) ? $data['schritt_1_dauer'] : null;
		$this->schritt_2_maschine = (!empty($data['schritt_2_maschine'])) ? $data['schritt_2_maschine'] : null;
		$this->schritt_2_dauer = (!empty($data['schritt_2_dauer'])) ? $data['schritt_2_dauer'] : null;
		$this->schritt_3_maschine = (!empty($data['schritt_3_maschine'])) ? $data['schritt_3_maschine'] : null;
		$this->schritt_3_dauer = (!empty($data['schritt_3_dauer'])) ? $data['schritt_3_dauer'] : null;
		$this->schritt_4_maschine = (!empty($data['schritt_4_maschine'])) ? $data['schritt_4_maschine'] : null;
		$this->schritt_4_dauer = (!empty($data['schritt_4_dauer'])) ? $data['schritt_4_dauer'] : null;
		$this->anz_soll = (!empty($data['anz_soll'])) ? $data['anz_soll'] : null;
		$this->anz_ist = (!empty($data['anz_ist'])) ? $data['anz_ist'] : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			for ($i = 1; $i <= 4; $i++) {
				$inputFilter->add(array(
						'name'     => 'schritt_'. $i .'_maschine',
						'required' => false,
						'filters'  => array(
								array('name' => 'Int'),
						),
						'validators' => array(
								array(
										'name' => 'Between',
										'options' => array(
												'min' => 1,
												'max' => 4,
										),
								),
						),
				));
				$inputFilter->add(array(
						'name'     => 'schritt_'. $i .'_dauer',
						'required' => false,
						'filters'  => array(
								array('name' => 'Int'),
						),
						'validators' => array(
								array(
										'name' => 'Between',
										'options' => array(
												'min' => 0,
												'max' => 65535,
										),
								),
						),
				));
			}
			
			$inputFilter->add(array(
					'name'     => 'anz_soll',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
					'validators' => array(
							array(
									'name' => 'Between',
									'options' => array(
											'min' => 1,
											'max' => 65535,
									),
							),
					),
			));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}
