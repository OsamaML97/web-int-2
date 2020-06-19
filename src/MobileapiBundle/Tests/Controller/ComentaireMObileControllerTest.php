<?php

namespace MobileapiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ComentaireMObileControllerTest extends WebTestCase
{
    public function testAllcomments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AllComments');
    }

    public function testFindcommentbyuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/FindCommentByUser');
    }

    public function testFindcommentbyid()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/FindCommentByID');
    }

    public function testNewcomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newComment');
    }

    public function testUpdatecomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/UpdateComment');
    }

    public function testDeletecomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteComment');
    }

}
