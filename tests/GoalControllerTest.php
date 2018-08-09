<?php
/**
 * Created by PhpStorm.
 * User: Kai
 * Date: 1/31/18
 * Time: 9:26 PM
 */

namespace Tests;
use GuzzleHttp\Client;

class GoalControllerTest extends \PHPUnit\Framework\TestCase
{
    private $http;

    public function setUp()
    {
        $this->http = new Client(['base_uri'=>'laravel.dev']);
    }

    public function test_creates_a_goal()
    {
        $expected = ['name'=>'Kai', 'value'=>'87'];

        $response = $this->http->request('GET','/goals');

        var_dump($response);
    }
}