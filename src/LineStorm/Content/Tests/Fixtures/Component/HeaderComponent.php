<?php

namespace LineStorm\Content\Tests\Fixtures\Component;

use LineStorm\Content\Component\AbstractHeaderComponent;
use LineStorm\Content\Component\ComponentInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Test class for abstract head component
 *
 * Class HeadComponent
 *
 * @package LineStorm\Content\Tests\Fixtures\Component
 */
class HeaderComponent extends AbstractHeaderComponent implements ComponentInterface
{
    /**
     * Fetch the component id string
     *
     * @return string
     */
    public function getId()
    {
        return 'header';
    }

    /**
     * Fetch the component name
     *
     * @return mixed
     */
    public function getName()
    {
        return 'header';
    }

    /**
     * Fetch the template for the view
     *
     * @param $entity
     *
     * @return string
     */
    public function getView($entity)
    {
    }

    /**
     * Check if the entity is supported by this component
     *
     * @param $entity
     *
     * @return boolean
     */
    public function isSupported($entity)
    {
        return true;
    }

    /**
     * Build the form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return mixed
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }
}
