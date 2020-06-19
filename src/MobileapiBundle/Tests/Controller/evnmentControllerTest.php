<?php

namespace MobileapiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class evnmentControllerTest extends WebTestCase
{
    public function testAllevenement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AllEvenement');
    }

    public function testParticiper()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Participer');
    }

    public function testFindparticiper()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/FindParticiper');
    }

    public function testFindparticiperall()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/FindParticiperAll');
    }

    public function testDeleteparticiper()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteParticiper');
    }

}
