# Cookie Consent Plugin

![Cookie Consent](assets/readme_1.png)

The **Cookie Consent** Plugin is for [Grav CMS](http://github.com/getgrav/grav). This grav plugin is to alert users about the use of cookies on your website. The plugin integrates the popular js lib [cookie consent](https://github.com/insites/cookieconsent/) by insites.

## Installation

Installing the Cookieconsent plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install cookieconsent

This will install the Cookieconsent plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/cookieconsent`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `cookieconsent`. You can find these files on [GitHub](https://github.com/naucon/grav-plugin-cookieconsent) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/cookieconsent
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/cookieconsent/cookieconsent.yaml` to `user/config/plugins/cookieconsent.yaml` and only edit that copy.

Here is the default configuration:

```yaml
enabled: true
```

## Advanced configuration

You can customize texts, shape and color with the following available options:

```yaml
# Include JavaScript and CSS files from official CDN or local
cdn: true
# Message on the banner (overwrite translation)
content_message: 'This website uses cookies to ensure you get the best experience on our website.'
# Dismiss button text (overwrite translation)
content_dismiss: 'Got it!'
# Policy link text (overwrite translation)
content_link: 'Learn more'
# Link to policy (overwrite translation)
content_href: 'https://cookiesandyou.com'

# Color of banner background
popup_background_color: '#000'
# Color of banner text
popup_text_color: '#fff'
# Color of button background
button_background_color: '#f1d600'
# Color of button text
button_text_color: '#000'
# Color of button border
button_border_color: '#f1d600'

# Position on the website, where the banner will be displayed.
# top = Top
# top-pushdown: Top (Pushdown)
# bottom: Bottom
# bottom-left: Bottom Left
# bottom-right: Bottom Right
position: bottom

# Button layout
# block: Block (angled corners)
# classic: Classic (round corners)
# edgeless: Edgeless
theme: block
```

### Translation

Translations are defined in the `languages.yaml` file.

Translations will be used if no `content_message`, `content_dismiss`, `content_link` or `content_href` are defined in `cookieconsent.yaml`.


### Known Issues

#### Incompatible themes

The plugin hooks into the grav asset manager (https://learn.getgrav.org/themes/asset-manager). Some themes haven't (properbly) integrated the assets manager and therefore do not work.

Have a look at the following required elements in the base theme. Without them the plugin will not work.

    {{ assets.css() }}
    {{ assets.js() }}



## License

The MIT License (MIT)

Copyright (c) 2015 Sven Sanzenbacher

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.