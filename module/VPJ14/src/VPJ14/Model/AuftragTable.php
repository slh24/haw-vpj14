<?php

namespace VPJ14\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Filter\Int;

class AuftragTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function getAuftrag($id) {
		$id  = (int) $id;
		$row = $this->tableGateway->select(array('id' => $id))->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		//$anz_soll = $row->
		return $row;
	}

	public function saveAuftrag(Auftrag $auftrag)
	{
		$data = array(
				'schritt_1_maschine' => $auftrag->schritt_1_maschine,
				'schritt_1_dauer' => $auftrag->schritt_1_dauer,
				'schritt_2_maschine' => $auftrag->schritt_2_maschine,
				'schritt_2_dauer' => $auftrag->schritt_2_dauer,
				'schritt_3_maschine' => $auftrag->schritt_3_maschine,
				'schritt_3_dauer' => $auftrag->schritt_3_dauer,
				'schritt_4_maschine' => $auftrag->schritt_4_maschine,
				'schritt_4_dauer' => $auftrag->schritt_4_dauer,
				'anz_soll' => $auftrag->anz_soll,
				'anz_ist' => 0,
				'zeit_eingabe' => new \Zend\Db\Sql\Expression("NOW()"),
		);

		$this->tableGateway->insert($data);
		return $this->tableGateway->lastInsertValue;
	}
}
