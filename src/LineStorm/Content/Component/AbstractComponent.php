<?php

namespace LineStorm\Content\Component;

use LineStorm\CmsBundle\Model\ModelManager;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\FormView;

/**
 * Class AbstractComponent
 * @package LineStorm\Content\Component
 */
abstract class AbstractComponent implements ComponentInterface
{
    const TYPE_HEADER   = 1;
    const TYPE_META     = 2;
    const TYPE_BODY     = 3;
    const TYPE_FOOTER   = 4;

    protected $name;
    protected $id;

    /**
     * @var ModelManager
     */
    protected $modelManager;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param ModelManager $modelManager
     * @param Container    $container
     */
    public function __construct(ModelManager $modelManager, Container $container)
    {
        $this->modelManager = $modelManager;
        $this->container = $container;
    }

    /**
     * Fetch the component id string
     *
     * @return string
     */
    abstract public function getId();

    /**
     * Fetch the component name
     *
     * @return mixed
     */
    abstract public function getName();

    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return array();
    }


    /**
     * Build the edit/creation form type
     *
     * @param FormView $view
     *
     * @return mixed
     */
    public function getForm(FormView $view)
    {
        return $this->container->get('templating')->render('LineStormCmsBundle:Component:form.html.twig', array(
            'form'          => $view,
            'component'     => $this,
        ));
    }

    /**
     * @inheritdoc
     */
    public function getViewAssets()
    {
        return array();
    }

    /**
     * Convert a string into a component type
     *
     * @param $type
     *
     * @return int|null
     */
    static function strToType($type)
    {
        $type = strtoupper($type);
        switch($type)
        {
            case 'HEADER':
                return self::TYPE_HEADER;
                break;
            case 'META':
                return self::TYPE_META;
                break;
            case 'BODY':
                return self::TYPE_BODY;
                break;
            case 'FOOTER':
                return self::TYPE_FOOTER;
                break;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getRoutes(Loader $loader)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAdminRoutes(Loader $loader)
    {
        return null;
    }

}
