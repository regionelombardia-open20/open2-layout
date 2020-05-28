Amos Basic Layout
-----------------------

Templates, layouts and styles for amos basic installation

Installation
------------

1. The preferred way to install this extension is through [composer](http://getcomposer.org/download/).
    
    Either run
    
    ```bash
    composer require open20/amos-layout
    ```
    
    or add
    
    ```
    "open20/amos-layout": "~1.0"
    ```
    
    to the require section of your `composer.json` file.
    
2.  Add module to your main config in common:
        
    ```php
    <?php
    $config = [
        'modules' => [
            'layout' => [
                'class' => 'open20\amos\layout\Module',
                'advancedLogoutActions' => true, // [OPTIONAL] if you want to display
                // two different logout buttons (one that redirects to login page and one that
                // redirects to main frontend page set in (common) params['platform']['frontendUrl'])
            ],
        ],
    ];
    ```
    
3. Add Bootstrap
        
    ```php
    <?php
    $config = [
       'bootstrap' => ['layout']
    ];
    ```

Tools
-----

Get base asset, required for all other assets, this mades easier to use a custom amosLayout instance 
```php
<?php

class MyCustomAppAsset extends AssetBundle
{
    public $depends = [];

    public function init()
    {
        $this->depends[] = \Yii::$app->layout->baseAssetClass;

        parent::init();
    }
}
```

PARAMS
-----
search navbar menu
```php
'searchNavbar' => true
```