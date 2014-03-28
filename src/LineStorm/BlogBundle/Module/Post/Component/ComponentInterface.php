<?php

namespace LineStorm\BlogBundle\Module\Post\Component;

use LineStorm\BlogBundle\Model\Post;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Templating\EngineInterface;

interface ComponentInterface
{
    public function getId();

    public function getName();

    public function getType();

    public function isSupported($entity);

    public function handleSave(Post $post, array $data);

    public function setTemplateEngine(EngineInterface $templating);

    public function getNewTemplate();

    public function getViewTemplate($entity);

    public function getEditTemplate($entity);

    public function buildForm(FormBuilderInterface $builder, array $options);
}
