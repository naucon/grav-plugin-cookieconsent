<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

/**
 * Class CookieconsentPlugin
 * @package Grav\Plugin
 */
class CookieconsentPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
        ]);
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * if enabled on this page, load the JS + CSS theme.
     */
    public function onTwigSiteVariables()
    {
        $twig   = $this->grav['twig'];
        $config = $this->config->toArray();

        if ($this->config->get('plugins.cookieconsent.cdn')) {
            $this->grav['assets']->addCss("//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.6/cookieconsent.min.css");
            $this->grav['assets']->addJs("//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.6/cookieconsent.min.js");
        } else {
            $this->grav['assets']->addCss("plugin://cookieconsent/assets/cookieconsent.min.css");
            $this->grav['assets']->addJs("plugin://cookieconsent/assets/cookieconsent.min.js");
        }

        $this->grav['assets']->addInlineJs($twig->twig->render('partials/cookieconsent.html.twig', array('config' => $config)));
    }
}
