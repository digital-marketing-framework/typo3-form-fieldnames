<?php

namespace DigitalMarketingFramework\Typo3\FormFieldnames;

use DigitalMarketingFramework\Core\Backend\Section\Section;
use DigitalMarketingFramework\Core\Backend\Section\SectionInterface;
use DigitalMarketingFramework\Core\Registry\RegistryDomain;
use DigitalMarketingFramework\Core\Registry\RegistryInterface;
use DigitalMarketingFramework\Typo3\Core\Typo3Initialization;
use DigitalMarketingFramework\Typo3\FormFieldnames\Backend\Controller\SectionController\FormFieldnamesSectionController;
use Mediatis\FormFieldnames\Service\FieldNameService;

/**
 * Registers the backend section that reports and fills in form field names.
 *
 * The section controller needs FieldNameService, which is a TYPO3 service. It is
 * injected here and handed to the registry as an additional constructor argument,
 * so that the controller receives it without the registry knowing about TYPO3.
 */
class Typo3FormFieldnamesInitialization extends Typo3Initialization
{
    public function __construct(
        protected FieldNameService $fieldNameService,
    ) {
        parent::__construct(
            packageName: 'typo3-form-fieldnames',
            packageAlias: 'dmf_form_fieldnames',
        );
    }

    /**
     * The card shown on the module overview and the entry in the section selector.
     *
     * @return array<SectionInterface>
     */
    protected function getBackendSections(): array
    {
        return [
            new Section(
                'Field Names',
                'FORMS',
                'page.form-fieldnames.index',
                'Review and fill in the names of form elements',
                'EXT:dmf_form_fieldnames/Resources/Public/Icons/dashboard-form-fieldnames.svg'
            ),
        ];
    }

    public function initPlugins(string $domain, RegistryInterface $registry): void
    {
        parent::initPlugins($domain, $registry);

        if ($domain === RegistryDomain::CORE) {
            $registry->registerBackendSectionController(
                FormFieldnamesSectionController::class,
                [$this->fieldNameService]
            );
        }
    }
}
