<?php

namespace LineStorm\CmsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAdminIndexForbiddenIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/cms/admin');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
    }
}
