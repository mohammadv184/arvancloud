<?php


namespace Mohammadv184\ArvanCloud\Tests;
use Mohammadv184\ArvanCloud\ArvanCloud;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function test(){
        var_dump(ArvanCloud::cdn()->dns()->cloud('0a7c52a2-582e-437c-8e13-478565973f6b'));
    }
}