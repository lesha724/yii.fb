# Yii LocalScripts CClientScript behavior

## How to attach

Add to config/main.php.

```php
'clientScript' => array(
    'class' => 'CClientScript',
    'behaviors' => array(
        array(
            'class' => 'ext.behaviors.localscripts.LocalScriptsBehavior',
        ),
    ),
),
```
