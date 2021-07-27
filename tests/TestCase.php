<?php


namespace Mohammadv184\ArvanCloud\Tests;
use Mohammadv184\ArvanCloud\ArvanCloud;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function test(){
        var_dump(ArvanCloud::cdn()->cache()->purge([
            'https://di-gi-mall.ir'
        ]));
    }
}