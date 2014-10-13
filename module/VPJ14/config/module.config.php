<?php

return array(
	'controllers' => array(
		'invokables' => array(
			'VPJ14\Controller\Auftrag' => 'VPJ14\Controller\AuftragController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'auftrag' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/auftrag[/][:action][/][:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'VPJ14\Controller\Auftrag',
						'action'     => 'index',
					),
				),
			),
		),
	),
	
	'view_manager' => array(
		'template_path_stack' => array(
			'auftrag' => __DIR__ . '/../view',
		),
	),
);
