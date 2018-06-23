<?php

namespace Grav\Plugin;

require_once __DIR__ . '/../../cookieconsent.php';

use Codeception\Util\Stub;
use Grav\Common\Assets;
use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Common\Twig\Twig;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * Class CookieconsentPluginTest
 */
class CookieconsentPluginTest extends \Codeception\Test\Unit
{
    /**
     * @var Grav
     */
    protected $grav;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var Twig
     */
    protected $twig;

    /**
     * @var \Twig\Environment
     */
    protected $twigEngine;

    /**
     * @var Assets
     */
    protected $assets;



    protected function _before()
    {
        $this->grav            = Stub::make(Grav::class);
        $this->config          = Stub::make(Config::class);
        $this->eventDispatcher = Stub::makeEmpty(EventDispatcherInterface::class);
        $this->twigEngine      = Stub::makeEmpty(\Twig\Environment::class);
        $this->twig            = Stub::make(Twig::class);
        $this->assets          = Stub::makeEmpty(Assets::class);
    }


    public function testGetSubscribedEvents()
    {
        $expectedResult = [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];

        $actualResult = CookieconsentPlugin::getSubscribedEvents();

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testOnPluginsInitialized()
    {
        $this->grav['events']  = $this->eventDispatcher;

        $plugin = new CookieconsentPlugin('Cookie Consent', $this->grav, $this->config);
        $plugin->onPluginsInitialized();
    }

    public function testOnTwigSiteVariables()
    {
        $this->grav['twig']    = $this->twig;
        $this->grav['assets']  = $this->assets;
        $this->twig->twig      = $this->twigEngine;

        $plugin = new CookieconsentPlugin('Cookie Consent', $this->grav, $this->config);
        $plugin->onTwigSiteVariables();
    }

    public function testOnTwigTemplatePaths()
    {
        $this->grav['twig'] = $this->twig;

        $plugin = new CookieconsentPlugin('Cookie Consent', $this->grav, $this->config);
        $plugin->onTwigTemplatePaths();
    }
}
