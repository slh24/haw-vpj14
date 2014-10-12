<?php

namespace VPJ14\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use VPJ14\Model\Auftrag;
use VPJ14\Form\AuftragForm;

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
	
	/* nicht benötigt, da auf Startseite keine Auftragsübersicht gezeigt wird
	public function indexAction()
	{
		return new ViewModel(array(
				'auftraege' => $this->getAuftragTable()->fetchAll(),
		));
	}*/

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
	    		$this->getAuftragTable()->saveAuftrag($auftrag);
	    
	    		// Redirect to list of auftrag's
	    		return $this->redirect()->toRoute('auftrag');
	    	}
	    }
	    return array('form' => $form);
	}
}
