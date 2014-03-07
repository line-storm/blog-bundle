<?php

namespace LineStorm\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use LineStorm\BlogBundle\Model\ModelManager;

class BlogPostType extends AbstractType
{
    protected $modelManager;

    function __construct(ModelManager $modelManager)
    {
        $this->modelManager = $modelManager;
        // TODO: Implement __construct() method.
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            //->add('createdOn', 'datetime')
            //->add('editedOn', 'datetime')
            ->add('liveOn', 'datetime', array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data'        => new \DateTime(),
            ))
            //->add('deletedOn')
            //->add('author')
            //->add('editedBy')
            ->add('category', 'entity', array(
                'class' => $this->modelManager->getEntityClass('category'),
                'property' => 'name',
            ))
            ->add('tags', 'entity', array(
                'multiple' => true,
                'class' => $this->modelManager->getEntityClass('tag'),
                'property' => 'name',
            ))
            //->add('parent')
            //->add('deletedBy')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->modelManager->getEntityClass('post')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linestorm_blogbundle_blogpost';
    }
}
