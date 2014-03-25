<?php

namespace LineStorm\BlogBundle\Module\Post\Component;

use LineStorm\BlogBundle\Model\Post;
use Symfony\Component\Templating\EngineInterface;

interface ComponentInterface
{
    public function getType();

    public function handleSave(Post $post, array $data);

    public function setTemplateEngine(EngineInterface $templating);

    public function getNewTemplate();

    public function getViewTemplate($entity);

    public function getEditTemplate($entity);
}
