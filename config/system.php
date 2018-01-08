<?php

// return [
// 	'guest_role_slug' => 'guest',
// 	'default_user_role' => 'subscriber',
// 	'widgetize_extracter' => [
// 				'title'=>'extract_widget_title',
// 				'show'=>'extract_widget_menu',
// 				'position' => 'extract_widget_position',
// 			],
// 	'positions' => ['user','left','right','top','footer'],
// ];
// 




return [
	//default guest slug role
	'guest_role_slug' => 'guest',

	//user given role on registration from client side
	'default_user_role' => 'subscriber',

	// user given role on registration from client side
	'multirole' => false,

	//terms and condition page url
	//make sure you provide full url
	'terms_and_condition_url' => 'http://mytnc-url/tnc',

	//force user to checkout in case of single item cart
	'force_single_item_purchase' => true, //true/false
	
	// callback to build and arrange column for widget columns
	
	/**** Template for user widgetized column ****/
	/**
	  'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'scope' => 'column', //{column, relation, configuration}//
		   	'callback' => 'extract_widget_title',
		   	'validations' => array('not_empty'),
		],
	**/
	/**
	 * What is a scope?
	 * Scope is a data management criteria to define the where to store the 
	 * data of created widget. Following are the possible combination of
	 * widgetize table scope. (column,relation, configuration)
	 * column: manage and build widgetize column data
	 * relation: if there is any relation, defined for widget,
	 * 			 for now widgets_menus
	 * configuration: manage the configuration column for widgetize table
	 * 
	 */
	
	/**
	 * 
	 * What is Widgetize Extracter?
	 * It helps us to store the information into the proper format into the 
	 * widgetize table, it is responsible to overwrite the default 
	 * configiration of the table.
	 * 
	 */
	'widgetize_extracter' => [
				// 'title'=>'extract_widget_title',
				// 'show'=>'extract_widget_menu',
				// 'position' => 'extract_widget_position',

				'title'      => [
					'title' => 'Title',
			    	'type' => 'text',
			    	'scope' => 'column',
			    	'callback' => 'extract_widget_title',
			    	'validations' => array('not_empty'),
			    ],
			    
			    'ordering' => [
				    'title' => 'Ordering',
				    'type' => 'text',
				    'validations' => array('not_empty'),
				    'scope' => 'column',
				    'multiple' => false,
				    'required'  => true,
				],

				'position' => [
				    'title' => 'Position',
				    'type' => 'select',
				    'validations' => array('not_empty'),
				    'callback' => 'position_list_build',
				    'scope' => 'column',
				    'multiple' => false,
				    'required'  => true,
				],

				'menus' => [
				    'title' => 'Choose to show on menu',
				    'type' => 'select',
				    'validations' => array('not_empty'),
				    'callback' => 'menu_item_build',
				    'scope' => 'relation',
				    'builder' => 'default',//'default' (user internal default widget based relationship manager),'external' (user builder_method by callback,
				    'builder_method' => 'sync', //,['sync','attach',detach]
				    'extractor' => 'widget_menus_extractor',
				    'extractor_key'  => 'id',
				    'multiple' => true,
				    'required'  => true,
				],

				'show_title' => [
				    'title' => 'Show title',
				    'type' => 'select',
				    'callback' => 'widget_true_false_options',
				    'scope' => 'configuration',
				    'multiple' => false,
				    'required'  => true,
				],

				'enabled' => [
				    'title' => 'Enabled',
				    'type' => 'select',
				    'validations' => array('not_empty'),
				    'callback' => 'widget_true_false_options',
				    'scope' => 'column',
				    'multiple' => false,
				    'required'  => true,
				],
			],
	
	//template positions
	
	'positions' => 
	[
		'default' => 'Default',
		'user'=>'User',
		'left'=>'Left',
		'right'=>'Right',
		'banner' => 'Banner',
		'containment' =>'Containment',
	],
];














// return [
// 	//default guest slug role
// 	'guest_role_slug' => 'guest',

// 	//user given role on registration from client side
// 	'default_user_role' => 'subscriber',
	
// 	// callback to build and arrange column for widget columns
	
// 	/**** Template for user widgetized column ****/
// 	/**
// 	  'title' => [
// 			'title' => 'Title',
// 		   	'type' => 'text',
// 		   	'scope' => 'column', //{column, relation, configuration}//
// 		   	'callback' => 'extract_widget_title',
// 		   	'validations' => array('not_empty'),
// 		],
// 	**/
// 	/**
// 	 * What is a scope?
// 	 * Scope is a data management criteria to define the where to store the 
// 	 * data of created widget. Following are the possible combination of
// 	 * widgetize table scope. (column,relation, configuration)
// 	 * column: manage and build widgetize column data
// 	 * relation: if there is any relation, defined for widget,
// 	 * 			 for now widgets_menus
// 	 * configuration: manage the configuration column for widgetize table
// 	 * 
// 	 */
	
// 	*
// 	 * 
// 	 * What is Widgetize Extracter?
// 	 * It helps us to store the information into the proper format into the 
// 	 * widgetize table, it is responsible to overwrite the default 
// 	 * configiration of the table.
// 	 * 
	 
// 	'widgetize_extracter' => [
// 				// 'title'=>'extract_widget_title',
// 				// 'show'=>'extract_widget_menu',
// 				// 'position' => 'extract_widget_position',

// 				'title'      => [
// 					'title' => 'Title',
// 			    	'type' => 'text',
// 			    	'scope' => 'column',
// 			    	'callback' => 'extract_widget_title',
// 			    	'validations' => array('not_empty'),
// 			    ],
// 				'position' => [
// 				    'title' => 'Position',
// 				    'type' => 'select',
// 				    'validations' => array('not_empty'),
// 				    'callback' => 'position_list_build',
// 				    'scope' => 'column',
// 				    'multiple' => false,
// 				    'required'  => true,
// 				],
// 				'sync' => [
// 				    'title' => 'Choose to show on menu',
// 				    'type' => 'select',
// 				    'validations' => array('not_empty'),
// 				    'callback' => 'menu_item_build',
// 				    'scope' => 'relation',
// 				    'multiple' => true,
// 				],
// 			],
	
// 	//template positions
	
// 	'positions' => 
// 	[
// 		'default' => 'Default',
// 		'user'=>'User',
// 		'left'=>'Left',
// 		'right'=>'Right',
// 	],
// ];
// 
			?>