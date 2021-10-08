# PieSocket PHP REST Client
PieSocket PHP REST client

## Configure

### Laravel
In `composer.json` add the following `post-autoload-dump` script at the top.
 
```
\\PieSocket\\Integrations\\Installer::setupLaravel
```
Example:
```
"scripts": {
    "post-autoload-dump": [
        "\\PieSocket\\Integrations\\Installer::setupLaravel",
        "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
        "@php artisan package:discover --ansi"
    ]
```

# Install

Make sure you have compelted the configuration for your integration (optional).

```
composer require piesocket/piesocket-php
```
