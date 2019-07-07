<?php

namespace Slepic\Tracy\Bar\TemplatedBarPanel;

/**
 * Interface TemplateDataProviderInterface
 * @package Slepic\Tracy\Bar\TemplatedBarPanel
 *
 * Provides data for tab and panel templates of the DefaultBarPanel.
 */
interface TemplateDataProviderInterface
{
    /**
     * @return array
     */
    public function getTabData();

    /**
     * @return array
     */
    public function getPanelData();
}
