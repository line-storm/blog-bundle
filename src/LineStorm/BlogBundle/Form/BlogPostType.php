<?php

namespace LineStorm\BlogBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostType extends AbstractBlogFormType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('liveOn', 'datetime', array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data'        => new \DateTime(),
            ))
            ->add('category', 'entity', array(
                'class'    => $this->modelManager->getEntityClass('category'),
                'property' => 'name',
            ))
            ->add('tags', 'collection', array(
                'type'      => new BlogTagType($this->modelManager),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                /*'multiple' => true,
                'class' => $this->modelManager->getEntityClass('tag'),
                'property' => 'name',*/
            ))

            ->add('article', 'collection', array(
                'type'      => new BlogPostArticleType($this->modelManager),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ));

        //->add('createdOn', 'datetime')
        //->add('editedOn', 'datetime')
        //->add('deletedOn')
        //->add('author')
        //->add('editedBy')
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
