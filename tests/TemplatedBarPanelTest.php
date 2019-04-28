<?php

namespace Slepic\Tests\Tracy\Bar\TemplatedBarPanel;

use PHPUnit\Framework\TestCase;
use Slepic\Templating\Template\TemplateInterface;
use Slepic\Tracy\Bar\TemplatedBarPanel\TemplateDataProviderInterface;
use Slepic\Tracy\Bar\TemplatedBarPanel\TemplatedBarPanel;
use Tracy\IBarPanel;

class TemplatedBarPanelTest extends TestCase
{
    /**
     * @var TemplateDataProviderInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $provider;

    /**
     * @var TemplateInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $tabTemplate;

    /**
     * @var TemplateInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $panelTemplate;

    /**
     * @var TemplatedBarPanel
     */
    private $panel;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->provider = $this->createMock(TemplateDataProviderInterface::class);
        $this->tabTemplate = $this->createMock(TemplateInterface::class);
        $this->panelTemplate = $this->createMock(TemplateInterface::class);
        $this->panel = new TemplatedBarPanel($this->provider, $this->tabTemplate, $this->panelTemplate);
    }

    /**
     * Tests that the TemplatedBarPanel implements IBarPanel
     *
     * @return void
     */
    public function testImplements()
    {
        $this->assertInstanceOf(IBarPanel::class, $this->panel);
    }

    /**
     * Tests that getTab connects the components properly.
     *
     * @param array $templateData
     * @param string $expectedOutput
     * @dataProvider provideData
     */
    public function testTab(array $templateData, $expectedOutput)
    {
        $this->provider->expects($this->once())
            ->method('getTabData')
            ->willReturn($templateData);
        $this->tabTemplate->expects($this->once())
            ->method('render')
            ->with($templateData)
            ->willReturn($expectedOutput);

        $output = $this->panel->getTab();
        $this->assertSame($expectedOutput, $output);
    }

    /**
     * Tests that getPanel connects the components properly.
     *
     * @param array $templateData
     * @param string $expectedOutput
     * @dataProvider provideData
     */
    public function testPanel(array $templateData, $expectedOutput)
    {
        $this->provider->expects($this->once())
            ->method('getPanelData')
            ->willReturn($templateData);
        $this->panelTemplate->expects($this->once())
            ->method('render')
            ->with($templateData)
            ->willReturn($expectedOutput);

        $output = $this->panel->getPanel();
        $this->assertSame($expectedOutput, $output);
    }

    /**
     * @return array
     */
    public function provideData()
    {
        return [
            [['test' => 'data'], \md5(\time())],
        ];
    }
}
