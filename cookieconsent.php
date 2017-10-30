<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

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
        $twig = $this->grav['twig'];
        $assets = $this->grav['assets'];
        $cookieConsentOptions = $this->config['plugins.cookieconsent'];

        // Configuration
        $builtInCss = $cookieConsentOptions['built_in_css'];
        $builtInJs = $cookieConsentOptions['built_in_js'];
        $loadJsOptionsBottom = $cookieConsentOptions['load_js_options_bottom'];

        // Load cookie consent CSS if enabled
        if (!$this->isAdmin() && $builtInCss) {

          // Add cookie consent CSS style
          $assets->addCss('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css');
        }

        // Load cookie consent JS if enabled
        if (!$this->isAdmin() && $builtInJs) {
          // Add cookie consent JS main script
          $assets->addJs('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js');

          // Add cookie consent JS settings
          $jsSettings = $twig->twig->render('partials/cookieconsent.html.twig', $cookieConsentOptions);
          $group = $loadJsOptionsBottom ? 'bottom' : null;
          $assets->addInlineJs($jsSettings, null, $group);
        }
    }
}
