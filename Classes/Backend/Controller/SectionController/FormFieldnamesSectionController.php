<?php

namespace DigitalMarketingFramework\Typo3\FormFieldnames\Backend\Controller\SectionController;

use DigitalMarketingFramework\Core\Backend\Controller\SectionController\SectionController;
use DigitalMarketingFramework\Core\Backend\Response\Response;
use DigitalMarketingFramework\Core\Registry\RegistryInterface;
use Mediatis\FormFieldnames\Service\FieldNameService;

/**
 * Shows which form elements have no field name yet, and fills them in.
 *
 * The analysis is read-only and is what the section shows by default. Writing is a
 * separate route, because the generated names are derived from labels and are meant
 * to be reviewed rather than accepted blindly.
 */
class FormFieldnamesSectionController extends SectionController
{
    /**
     * @param array<string> $routes
     */
    public function __construct(
        string $keyword,
        RegistryInterface $registry,
        protected FieldNameService $fieldNameService,
        array $routes = [],
    ) {
        parent::__construct($keyword, $registry, 'form-fieldnames', ['index', 'migrate', 'migrate-all', ...$routes]);
    }

    protected function indexAction(): Response
    {
        $this->assignCurrentRouteData();
        $this->viewData['analyses'] = $this->fieldNameService->analyseAll();

        return $this->render();
    }

    /**
     * Fills in the missing names of a single form.
     */
    protected function migrateAction(): Response
    {
        $persistenceIdentifier = $this->getParameters()['form'] ?? '';
        if (is_string($persistenceIdentifier) && $persistenceIdentifier !== '') {
            $this->fieldNameService->migrate($persistenceIdentifier);
        }

        return $this->redirect('page.form-fieldnames.index');
    }

    /**
     * Fills in the missing names of every form that has any.
     */
    protected function migrateAllAction(): Response
    {
        $this->fieldNameService->migrateAll();

        return $this->redirect('page.form-fieldnames.index');
    }
}
