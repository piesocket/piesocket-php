# PieSocket PHP REST Client
PieSocket PHP REST client

## Configure

Skip to [installation](#installation) 

### Laravel
#### Quick start
Use the starter project: [piesocket/laravel-broadcasting-starter](https://github.com/piesocket/laravel-broadcasting-starter)

### Manual
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

Add PieSocket driver in `connections` array of `config\broadcasting.php` alongside `pusher` configuration.
```
'piesocket' => [
  'driver' => 'piesocket',
  'key' => env('PIESOCKET_API_KEY'),
  'secret' => env('PIESOCKET_API_SECRET'),
  'cluster_id' => env('PIESOCKET_CLUSTER_ID'),
]
```

Documentation: [Laravel Broadcasting with PieSocket](https://www.piesocket.com/blog/laravel-echo-broadcasting/)

## Installation

Make sure you have completed the configuration for your integration (optional).

```
composer require piesocket/piesocket-php
```
