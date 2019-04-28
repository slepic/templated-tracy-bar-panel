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
     * @return mixed
     */
    public function getTabData();

    /**
     * @return mixed
     */
    public function getPanelData();
}
