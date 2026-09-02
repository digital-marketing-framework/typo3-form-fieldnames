<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Anyrel Form Field Names',
    'description' => 'Anyrel backend section for reviewing and filling in form field names.',
    'category' => 'be',
    'author_email' => 'info@mediatis.de',
    'author_company' => 'Mediatis AG',
    'state' => 'stable',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'php' => '8.2.0-8.5.99',
            'typo3' => '12.4.0-14.99.99',
            'form' => '12.4.0-14.99.99',
            'form_fieldnames' => '4.3.0-4.99.99',
            'dmf_core' => '4.0.0-4.99.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
