Creating a module
=================

Creating a module is quite easy. To start, take a look at the
[ModuleInterface](../src/LineStorm/CmsBundle/Module/ModuleInterface) interface and the
[AbstractModule](../src/LineStorm/CmsBundle/Module/AbstractModule). These are our base module files that we will be using.

Creating page module
====================
Lets create a module that will allow us to create very basic pages via the admin interface (i.e. a very primitive CMS!).

Step 1: Create the class
------------------------

To start, we extend the `AbstractModule` and implement the `ModuleInterface`:

```php
<?php

namespace Acme\PageBundle\Module;

use LineStorm\CmsBundle\Module\AbstractModule;
use LineStorm\CmsBundle\Module\ModuleInterface;

class PageModule extends AbstractModule implements ModuleInterface
{
    protected $name = 'Page';
    protected $id = 'page';
}
```

Both `$name` and `$id` are returned by the `AbstractModule`, so we don't need to worry about implementing their getters:

* `$name` is the friendly name of the module
* `$id` is the unique identifier for the module it is also used to build the relationship between entities

Step 2: Implement Routes
------------------------
Each module has 2 types of routes: frontend and backend:

* Frontend should supply generic implementation of the module. In our case, we will need it to display content on each
  page. We can also specifiy that API here, if we need one.
* Backend should be how content is generated (i.e. the forms to create our content).

To tell LineStorm where to look for the routes, we need to implement 2 methods:

```php
    public function addRoutes(Loader $loader)
    {
        return $loader->import('@AcmeDemoBundle/Resources/config/routing/frontend.yml', 'rest');
        return $loader->import('@AcmeDemoBundle/Resources/config/routing/api.yml', 'rest');
    }

    public function addAdminRoutes(Loader $loader)
    {
        return $loader->import('@AcmeDemoBundle/Resources/config/routing/admin.yml', 'yaml');
    }
```

By using the Loader class, we can import any config file, or generate our own dynamic Route classes. Both methods must
return a RouteCollection.

Step 3: Admin Navigation
------------------------
Lastly, LineStorm needs to know the navigation structure and defaule homepage. We can do this by implementing the
following:

```php
    public function getNavigation()
    {
        return array(
            'View All Pages' => array('acme_cms_admin_module_page_list', array()),
            'New Page' => array('acme_cms_admin_module_page_create', array()),
        );
    }

    public function getHome()
    {
        return 'acme_cms_admin_module_page';
    }
```

* `getNavigation` must return an array of "[link text] => [route definition]" key/value pairs.
* `getHome` must return the route name of the module's home page

Step 4: Models
--------------
Each page is going to be stored in the database, so we're going to need to tell LineStorm about our Models. We do this
by adding a compiler class call for the orm mappings. If you dont know what I just said, don't worry - it's as easy as
adding this to your Acme\DemoBunle\AcmeDemoBunle class:

```php
    use use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\DoctrineOrmCompilerPass;

    ...

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $modelDir = realpath(__DIR__.'/Resources/config/model/doctrine');
        $mappings = array(
            $modelDir => 'Acme\DemoBundle\Model',
        );
        $container->addCompilerPass(DoctrineOrmCompilerPass::getMappingsPass($mappings));
    }
```

This maps all our `[Model].orm.xml` mappings to our models in `Acme\DemoBundle\Model`. Great!

So lets add a model and a mappings file:

Acme/DemoBundle/Resources/config/model/doctrine/Page.orm.xml
```xml
<?xml version="1.0" encoding="utf-8"?>
<doctrine-mapping
    xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

  <mapped-superclass name="Acme\DemoBundle\Model\Page">
    <field name="name" type="string" column="name" length="100" precision="0" scale="0" nullable="false"/>
    <field name="body" type="text" column="body" precision="0" scale="0" nullable="false"/>
    <field name="route" type="string" column="route" length="100" precision="0" scale="0" nullable="false"/>
    <field name="createdOn" type="datetime" column="created_on" precision="0" scale="0" nullable="false"/>
  </mapped-superclass>

</doctrine-mapping>
```

```php
<?php

namespace Acme\DemoBundle\Model;

use Doctrine\ORM\Mapping as ORM;

abstract class Poll
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var \DateTime
     */
    protected $createdOn;

}
```

And that, more or less, is all the LineStorm specific configuration you have to do! All that's left is to implement all
your routes that you have provided LineStorm. In a more complex system (like our
[page module](https://github.com/linestorm/page-bundle)!, you can set these thing in the admin panel.

The admin routes should implement forms on which you can insert the pages into the database (Symfony Forms seem to do
the trick), and the frontend routes should load view side to the page.

