<?php

namespace LineStorm\Content\Tests\Fixtures\Component;

use LineStorm\Content\Component\AbstractBodyComponent;
use LineStorm\Content\Component\ComponentInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Test class for abstract body component
 *
 * Class BodyComponent
 *
 * @package LineStorm\Content\Tests\Fixtures\Component
 */
class BodyComponent extends AbstractBodyComponent implements ComponentInterface
{
    /**
     * Fetch the component id string
     *
     * @return string
     */
    public function getId()
    {
        return 'body';
    }

    /**
     * Fetch the component name
     *
     * @return mixed
     */
    public function getName()
    {
        return 'body';
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

    /**
     * Return a list of form elements to render on the content node form. This allows LineStormCMS to group component
     * inputs together.
     *
     * @return array
     */
    public function getFormFields()
    {
        return array();
    }


    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return array(
            'asset1' => 'value1',
            'asset2' => 'value2'
        );
    }

} 
