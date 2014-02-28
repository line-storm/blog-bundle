LineStorm Blog Bundle
=====================

Blog Bundle for symfony >=2.3

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
line_storm_blog:
  entity_manager: default
  entity_classes:
    post:       Acme\DemoBundle\Entity\BlogPost
    tag:        Acme\DemoBundle\Entity\BlogTag
    category:   Acme\DemoBundle\Entity\BlogCategory
    user:       Acme\DemoBundle\Entity\User
    user_group: Acme\DemoBundle\Entity\Group
```

routing.yml
-----------
Add this route in `app/config/routing.yml`

```yml
linestorm_blog:
    type:       linestorm_blog
    resource:   LineStorm\BlogBundle\Controller\BlogController
    prefix:     /blog
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
As will all symfony2 bundles, you can override the default templates by adding files under `app/Resources/LineStromBlogBundle/views/...`
