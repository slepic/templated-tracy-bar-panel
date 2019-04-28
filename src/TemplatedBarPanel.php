<?php

namespace Slepic\Tracy\Bar\TemplatedBarPanel;

use Slepic\Templating\Template\TemplateInterface;
use Tracy\IBarPanel;

/**
 * Class TemplatedBarPanel
 * @package Slepic\Tracy\Bar\TemplatedBarPanel
 *
 * Provides generic implementation of IBarPanel
 * using two instances of TemplateInterface and a TemplateDataProviderInterface.
 *
 * This panel should have all it needs and allows you to implement IBarPanel factory classes instead of implementing IBarPanel directly.
 */
class TemplatedBarPanel implements IBarPanel
{
    /**
     * @var TemplateDataProviderInterface
     */
    private $dataProvider;

    /**
     * @var TemplateInterface
     */
    private $tabTemplate;

    /**
     * @var TemplateInterface
     */
    private $panelTemplate;

    /**
     * TemplatedBarPanel constructor.
     * @param TemplateDataProviderInterface $dataProvider
     * @param TemplateInterface $tabTemplate
     * @param TemplateInterface $panelTemplate
     */
    public function __construct(
        TemplateDataProviderInterface $dataProvider,
        TemplateInterface $tabTemplate,
        TemplateInterface $panelTemplate
    ) {
        $this->dataProvider = $dataProvider;
        $this->tabTemplate = $tabTemplate;
        $this->panelTemplate = $panelTemplate;
    }

    /**
     * @return string
     */
    public function getTab()
    {
        $data = $this->dataProvider->getTabData();
        return $this->tabTemplate->render($data);
    }

    /**
     * @return string
     */
    public function getPanel()
    {
        $data = $this->dataProvider->getPanelData();
        return $this->panelTemplate->render($data);
    }
}
