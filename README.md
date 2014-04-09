LineStorm CMS Bundle
=====================

LineStorm CMS Bundle for symfony >=2.3.

This bundle is pretty useless on it's own, as it's just the core files. You will need to install various modules to make
it meaningful.

Configuration
=============

Dependencies
------------
FosUserBundle
FosRestBundle

config.yml
----------
Add these config options in `app/config/config.yml`

```yml
line_storm_cms:
  entity_manager: default
  entity_classes:
    ...:       Acme\DemoBundle\Entity\...
```

routing.yml
-----------
Add this route in `app/config/routing.yml`

```yml
acme_cms:
    resource:   "@LineStormBlogBundle/Resources/config/routing.yml"

linestorm_cms_routes:
  resource: .
  type:     linestorm_cms
  prefix:   /path/to/cms
```

AppKernel.php
-------------
Add these classes to the `app/AppKernel.php`

```php
    new FOS\UserBundle\FOSUserBundle(),
    new FOS\RestBundle\FOSRestBundle(),
    new JMS\SerializerBundle\JMSSerializerBundle(),
    new LineStorm\BlogBundle\LineStormBlogBundle(),
```

Twig Template Overrides
-----------------------
As with all symfony2 bundles, you can override the default templates by adding files under `app/Resources/LineStromBlogBundle/views/...`
