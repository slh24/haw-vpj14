<?php

namespace VPJ14\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use VPJ14\Model\Auftrag;
use VPJ14\Form\AuftragForm;
use VPJ14\Form\AuftragStateForm;

class AuftragController extends AbstractActionController
{
	protected $auftragTable;
	
	public function getAuftragTable()
	{
		if (!$this->auftragTable) {
			$sm = $this->getServiceLocator();
			$this->auftragTable = $sm->get('VPJ14\Model\AuftragTable');
		}
		return $this->auftragTable;
	}

	/*
	 * Einen Auftrag erstellen
	 */
	public function addAction()
	{
	    $form = new AuftragForm();
	    $form->get('submit')->setValue('Erstellen');
	    
	    $request = $this->getRequest();
	    if ($request->isPost()) {
	    	$auftrag = new Auftrag();
	    	$form->setInputFilter($auftrag->getInputFilter());
	    	$form->setData($request->getPost());
	    
	    	if ($form->isValid()) {
	    		$auftrag->exchangeArray($form->getData());
	    		$id = $this->getAuftragTable()->saveAuftrag($auftrag);
	    
	    		// Redirect to list of auftrag's
	    		return $this->redirect()->toRoute('auftrag', array('action' => 'state', 'id' => $id));
	    	}
	    }
	    return array('form' => $form);
	}
	
	/*
	 * Den Auftragsstatus abrufen
	 */
	public function stateAction() {
		$form  = new AuftragStateForm();
		
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			$request = $this->getRequest();
			if ($request->isPost()) {
				$id = (int) $request->getPost()->id;
				
				if ($id) {
					// Redirect to list of auftrag's
					return $this->redirect()->toRoute('auftrag', array('action' => 'state', 'id' => $id));
				}
				return array('form' => $form, 'message' => 'Bitte geben Sie eine gültige Auftrags-ID an.');
			}
			
			return array('form' => $form);
		}
		
		// Get the Auftrag with the specified id.  An exception is thrown
		// if it cannot be found, in which case go to the index page.
		try {
			$auftrag = $this->getAuftragTable()->getAuftrag($id);
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('auftrag', array('action' => 'state'));
		}
		
		$form_bind = new \ArrayObject(array('id' => $id));
		$form->bind($form_bind);
		
		$anz_soll = $auftrag->anz_soll;
		$anz_ist = $auftrag->anz_ist;
		
		return array(
				'id' => $id,
				'form' => $form,
				'anz_soll' => $anz_soll,
				'anz_ist' => $anz_ist,
		);
	}
}
