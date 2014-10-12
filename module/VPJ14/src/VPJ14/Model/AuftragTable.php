<?php

namespace VPJ14\Model;

use Zend\Db\TableGateway\TableGateway;

class AuftragTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
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
	}
}
