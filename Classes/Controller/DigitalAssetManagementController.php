<?php
declare(strict_types = 1);

/*
 * This file is part of the package lns/digital-asset-management.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace TYPO3\CMS\DigitalAssetManagement\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Backend controller: The "Digital Asset Management" module
 *
 * Optional replacement of filelist
 */
class DigitalAssetManagementController
{
    /**
     * @var ModuleTemplate
     */
    protected $moduleTemplate;

    /**
     * @var ViewInterface
     */
    protected $view;

    /**
     * Default constructor
     */
    public function __construct()
    {
//        $this->siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
        $this->moduleTemplate = GeneralUtility::makeInstance(ModuleTemplate::class);
    }

    /**
     * @param string $templateName
     */
    protected function initializeView(string $templateName): void
    {
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->setTemplate($templateName);
        $this->view->setTemplateRootPaths(['EXT:digital_asset_management/Resources/Private/Templates']);
        $this->view->setPartialRootPaths(['EXT:digital_asset_management/Resources/Private/Partials']);
        $this->view->setLayoutRootPaths(['EXT:digital_asset_management/Resources/Private/Layouts']);
    }

    /**
     * Main entry method: Dispatch to other actions - those method names that end with "Action".
     *
     * @param ServerRequestInterface $request the current request
     * @return ResponseInterface the response with the content
     */
    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        //        $this->moduleTemplate->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Backend/ContextMenu');
        //include JavaScript and CSS
        /**
         * @var PageRenderer $pageRenderer
         */
        $pageRenderer = $this->moduleTemplate->getPageRenderer();
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/DigitalAssetManagement/DigitalAssetManagementActions');
        //        $this->moduleTemplate->loadJavascriptLib('EXT:digital_asset_management/Resources/Public/JavaScript/DigitalAssetManagementActions.js');
        //$this->moduleTemplate->loadJavascriptLib('https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js');
        $pageRenderer->addCssFile('EXT:digital_asset_management/Resources/Public/Css/digitalassetmanagement.css');
        $pageRenderer->addInlineLanguageLabelFile('EXT:digital_asset_management/Resources/Private/Language/locallang_mod.xlf');
        $pageRenderer->addInlineLanguageLabelFile('EXT:core/Resources/Private/Language/locallang_core.xlf', 'file_upload');
        //Include bootstrap css
        //@todo: include bootstrap css from TYPO3 not from CDN, how to?
        $pageRenderer->addCssFile('EXT:digital_asset_management/Resources/Public/Css/bootstrap.min.css');
        // $pageRenderer->addCssFile('EXT:backend/Resources/Public/Css/backend.css');
        $this->initializeView('index');
        // Add shortcut button
        $buttonBar = $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();
        $myButton = $buttonBar->makeShortcutButton()->setModuleName('dam');
        $buttonBar->addButton($myButton);
        $this->moduleTemplate->setContent($this->view->render());
        return new HtmlResponse($this->moduleTemplate->renderContent());
    }
}
