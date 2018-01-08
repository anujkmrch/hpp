<?php

return [
	'course'=>[
		// 'id' => [
		// 	'title' => 'Id',
		//    	'type' => 'text',
		//    	'scope' => 'column', //{column, relation, configuration}//
		//    	'callback' => 'dsvv_extract_course_id',
		//    	'validations' => array('not_empty'),
		// ],
		'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'callback' => 'dsvv_extract_course_title',
		   	'scope' => 'column', //{column, relation, configuration}//
		],
		'code' => [
			'title' => 'code',
		   	'type' => 'text',
		   	'callback' => 'dsvv_extract_course_code',
		   	'scope' => 'column', //{column, relation, configuration}//
		],
		
		'course_session_id' => [
			'title' => 'Session',
		   	'type' => 'select',
		   	'scope' => 'column', //{column, relation, configuration}//
		   	'callback' => 'dsvv_extract_course_session_list',
		],
		'amount' => [
			'title' => 'Application fees',
		   	'type' => 'text',
		   	'callback' => 'dsvv_extract_application_fees',
		   	'scope' => 'column', //{column, relation, configuration}//
		],

		'enabled' => [
			'title' => 'Status',
		   	'type' => 'select',
		   	'scope' => 'column', //{column, relation, configuration}//
		   	'callback' => 'dsvv_extract_course_status',
		],

		'configuration' => [
			'title' => 'Certificate required',
		   	'type' => 'checkbox',
		   	'scope' => 'configuration', //{column, relation, configuration}//
		   	'callback' => 'dsvv_extract_course_requirements',
		],
	],

	'session'=>[
		'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'callback' => 'dsvv_extract_course_title',
		   	'scope' => 'column', //{column, relation, configuration}//
		],
		'application_starts_on' => [
			'title' => 'Application Starts on',
		   	'type' => 'date',
		   	'callback' => 'dsvv_extract_course_code',
		   	'scope' => 'column', //{column, relation, configuration}//
		],

		'applications_ends_on' => [
			'title' => 'Application Ends on',
		   	'type' => 'date',
		   	'callback' => 'dsvv_extract_course_code',
		   	'scope' => 'column', //{column, relation, configuration}//
		],

		'starts_from' => [
			'title' => 'Course starts from',
		   	'type' => 'date',
		   	'callback' => 'dsvv_extract_course_code',
		   	'scope' => 'column', //{column, relation, configuration}//
		],

		'ends_on' => [
			'title' => 'Course ends on',
		   	'type' => 'date',
		   	'callback' => 'dsvv_extract_course_code',
		   	'scope' => 'column', //{column, relation, configuration}//
		],

		// 'enabled' => [
		// 	'title' => 'Status',
		//    	'type' => 'select',
		//    	'scope' => 'column', //{column, relation, configuration}//
		//    	'callback' => 'dsvv_extract_course_status',
		// ],
	],
];
?>