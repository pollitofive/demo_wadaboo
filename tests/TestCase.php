<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function withUTF8($text)
    {
        return mb_detect_encoding($text,'UTF-8');
    }

}
