Activity logger
===============

Installation
------------

```sh
$ composer require geniv/nette-activity-logger
```
or
```json
"geniv/nette-activity-logger": ">=1.0.0"
```

require:
```json
"php": ">=7.0.0",
"nette/nette": ">=2.4.0",
"geniv/nette-general-form": ">=1.0.0"
```

Include in application
----------------------

Automatic block url segment `_fid`.

This segment you can add `getBlock()` and `setBlock(array $block)`.

neon configure:
```neon
services:
#    - ActivityLogger
    - ActivityLogger(%wwwDir%/../log/activity-logger.neon)
```

presenters:
```php
protected function createComponentActivityLogger(ActivityLogger $activityLogger): ActivityLogger
{
    return $activityLogger;
}
```

usage:
```latte
{control activityLogger}

{* disable render but still logging *}
{control activityLogger, false}
```
