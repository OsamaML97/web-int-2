<?php

namespace MobileapiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class factureControllerTest extends WebTestCase
{
    public function testAddfacture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ADDFacture');
    }

    public function testAllfacture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ALLFacture');
    }

    public function testPayefacture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/PayeFacture');
    }

}
