LineStorm CMS Bundle
=====================

LineStorm CMS is a Content Management System Bundle for symfony >=2.3.

This bundle is pretty useless on it's own as it's just the core files. You will need to install various modules to make
it meaningful.

Configuration
=============
1. Download and Enable
2. Configure the Bundle
3. Install some modules

Step 1: Download and Enable
---------------------------

Add `linestorm/linestorm-cms` to your `composer.json` and add `new LineStorm\CmsBundle\CmsBundle(),` to your `app/AppKernel.php` file.

Step 2: Configure the Bundle
----------------------------

There is very little configuration that is needed for this bundle as it doesn't actually do anything on its own, but 
there is configurations that you should know about:

###config.yml

Add these config options in `app/config/config.yml`:

```yml
line_storm_cms:
  entity_manager: default
  backend_type: orm
  entity_classes:
    ...:       Acme\DemoBundle\Entity\...
```

* entity_manager refers to the entity manager id to use
* backend_type refers to the backend database type. Currently only orm (Doctrine) is supported
* entity_classes is an array of "id: [class namespace]" scalars LineStorm needs to know about your entity classes for
  your modules to be able to access them. Each module you install will tell you what classes to have here

###routing.yml

Add this route in `app/config/routing.yml`

```yml
acme_cms:
  resource: .
  type:     linestorm_cms
  prefix:   /blog

acme_cms_admin:
    resource:   "@LineStormCmsBundle/Resources/config/routing.yml"
```

* acme_cms is your frontend route controller
* acme_cms_admin is your backend routes


Step 3: Install some modules
----------------------------
Modules are what do all the work in LineStorm. To see a few modules, take a look at the [LineStorm Organisation on GitHub](https://github.com/linestorm)


Documentation
=============
To see the full documentation, see  [docs/](docs/index.md)
