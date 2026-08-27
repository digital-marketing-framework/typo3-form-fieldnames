<?php

namespace DigitalMarketingFramework\Typo3\FormFieldnames\Registry\EventListener;

use DigitalMarketingFramework\Typo3\Core\Registry\EventListener\AbstractCoreRegistryUpdateEventListener;
use DigitalMarketingFramework\Typo3\FormFieldnames\Typo3FormFieldnamesInitialization;
use Mediatis\FormFieldnames\Service\FieldNameService;

class CoreRegistryUpdateEventListener extends AbstractCoreRegistryUpdateEventListener
{
    public function __construct(FieldNameService $fieldNameService)
    {
        parent::__construct(new Typo3FormFieldnamesInitialization($fieldNameService));
    }
}
