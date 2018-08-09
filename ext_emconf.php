<?php

/*
 * This file is part of the package lns/digital-asset-management.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Digital Asset Management',
    'description' => 'Modern way presenting files',
    'category' => 'file',
    'state' => 'experimental',
    'author' => 'Schaffrath DigitalMedien',
    'author_email' => 'info@schaffrath-digital.de',
    'author_company' => '',
    'version' => '0.0.1',
    'autoload' => [
        'psr-4' => [
            'TYPO3\\CMS\\DigitalAssetManagement\\' => 'Classes'
        ],
    ],
    'constraints' => [
        'depends' => [
            'typo3' => '9.0.0-9.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
