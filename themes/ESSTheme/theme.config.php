<?php
return [
	'extends' => 'bootstrap3',
	'css' => [
		'style.css',
        'jquery.dataTables.min.css'
	],
	'js' => [
        ['file' => 'jquery.min.js', 'priority' => 350],
        // ['file' => 'jquery.dataTables.min.js', 'priority' => 350],
        ['file' => 'jquery.dataTables.min.js', 'priority' => 355, 'position' => 'footer'],
        ['file' => 'api_call_by_ajax.js', 'priority' => 360],
        ['file' => 'homeJournalData.js', 'priority' => 365],
        ['file' => 'api_call_for_accessed.js', 'priority' => 370],  
        // ['file' => 'DDRAvailablebtn.js', 'priority' => 380], 
        ['file' => 'saveUserDetails.js', 'priority' => 380],   
    ],
    'helpers' => [
        'factories' => [
            'Inflibnet\View\Helper\Root\Record' => 'Inflibnet\View\Helper\Root\RecordFactory',
        ],
        'aliases' => [
            'record' => 'Inflibnet\View\Helper\Root\Record',
        ],
    ],
];