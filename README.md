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

neon configure:
```neon
services:
    - ActivityLogger
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
```
