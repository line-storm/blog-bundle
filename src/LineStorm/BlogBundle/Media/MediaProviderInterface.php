<?php

namespace LineStorm\BlogBundle\Media;


use LineStorm\BlogBundle\Model\Media;
use Symfony\Component\HttpFoundation\File\File;

interface MediaProviderInterface
{
    public function getId();

    public function getEntityClass();

    public function find($id);

    public function findBy(array $criteria, array $order = array(), $limit = null, $offset = null);

    public function store(File $file, Media $media=null);

    public function update(Media $media);
} 
