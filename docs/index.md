LineStorm CMS Bundle Documentation
==================================

LineStorm consists of a collection of modules.

Modules
-------
Modules provide interfaces to manage functionality within the CMS. For example, the
[media module](https://github.com/linestorm/media-bundle) manages image upload and manipulation and the
[search module](https://github.com/linestorm/search-bundle) manages indexing and searching text bodies.

Modules are managed by the [ModelManager](../src/LineStorm/CmsBundle/Module/ModuleManager.php). To register a module with
the manager, you need to tag your model service with `linestorm.cms.module`, and LineStorm will to all the rest for you.
In your app, you can reference the manager by calling `$container->get('module_manager')`.

* [Create a module](module_create.md)

Models
------
Models in LineStorm and Entities in Symfony2. The model manager provides an interface similar to the Doctrine Manager to
centralise object manipulation and can be called using `$container->get('model_manager')`. In fact, the model manager
returns Doctrine Repositories of the requested models. Models are defined in the app/config/config.yml as such:

```yml
line_storm_cms:
  entity_classes:
    model_name:      Acme\DemoBundle\Entity\Entity
    model_two_name:  Acme\DemoBundle\Entity\EntityTwo
```

Thus, to get the entity named EntityTwo, you would call `$container->get('model_manager')->get('model_two_name')`.

Assets
------

###Twig Constants
You will need to configure the `assetsPath` in your config file for twig:

```yml
twig:
    globals:
      assetsPath: 'assets'
```

###JavaScript

####Bower
Using bower, we can install all the required libs [.bower.json](../.bower.json)

####RequireJS
The admin interface uses [requirejs](http://requirejs.org/) to load javascript assets. The root requirejs script is 
called `common`. The `baseUrl` is `{{ assetsPath }}/js`.
See [requirejs.html.twig](../src/LineStorm/CmsBundle/Resources/views/requirejs.html.twig) for more details.

An example `common.js` would look like:

```js
requirejs.config({
    paths: {
        domReady:   '../vendor/requirejs-domready/domReady',
        jquery:     '../vendor/jquery/dist/jquery',
        jqueryui:   '../vendor/jquery-ui/ui/jquery-ui',
        bootstrap:  '../vendor/bootstrap/dist/js/bootstrap',

        // any module paths
    },
    shim: {
        dropzone:   ['jquery'],
        jqueryui:   ['jquery'],
        bootstrap:  ['jquery'],
    }
});
```

Each module should implement JavaScript scripts using RequireJS and should specify which paths and shims to add in their
readme.

###CSS
The css is generated from scss via assetic.


Roadmap
=======
[View the LineStormCMS Roadmap](roadmap.md)
