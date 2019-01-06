<?php

namespace BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{
    public function testShowByDateRangeAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'show-by-date-range');
    }

}
