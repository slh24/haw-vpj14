<?php

namespace VPJ14;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use VPJ14\Model\Auftrag;
use VPJ14\Model\AuftragTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'VPJ14\Model\AuftragTable' =>  function($sm) {
    				$tableGateway = $sm->get('AuftragTableGateway');
    				$table = new AuftragTable($tableGateway);
    				return $table;
    			},
    			'AuftragTableGateway' => function ($sm) {
    				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$resultSetPrototype = new ResultSet();
    				$resultSetPrototype->setArrayObjectPrototype(new Auftrag());
    				return new TableGateway('vpj_auftraege', $dbAdapter, null, $resultSetPrototype);
    			},
    		),
    	);
    }
    
}
