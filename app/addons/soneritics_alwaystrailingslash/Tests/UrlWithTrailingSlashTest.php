<?php
/*
 * The MIT License
 *
 * Copyright 2019 Jordi Jolink.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../Logic/UrlWithTrailingSlash.php';
require_once __DIR__ . '/../Logic/UrlWithTrailingSlashProcessor.php';

class UrlWithTrailingSlashTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var array test set
     */
    private $testSet = [
        'http://domain.com' => 'http://domain.com/',
        'http://domain.com/page1/page2' => 'http://domain.com/page1/page2/',
        'http://domain.com/page1/page2?param=1' => 'http://domain.com/page1/page2/?param=1',
        'http://domain.com/page1/page2?param=1&param2=yes' => 'http://domain.com/page1/page2/?param=1&param2=yes',
        'http://domain.com/page1/page2?param=1?param2=yes' => 'http://domain.com/page1/page2/?param=1?param2=yes',
    ];

    private $testSetExcludedFiles = [
        'http://domain.com/index.php' => 'http://domain.com/index.php',
        'http://domain.com/index.php?action=true&param=false' => 'http://domain.com/index.php?action=true&param=false',
    ];

    /**
     * Test if slashing happens correct
     */
    public function testCorrectSlashing()
    {
        foreach ($this->testSet as $unslashed => $slashed) {
            $this->assertEquals(
                $slashed,
                (new UrlWithTrailingSlash($unslashed))->getUrlWithSlash()
            );
        }
    }

    /**
     * Test if already slashed URLs are detected
     */
    public function testComparisonIsSlashed()
    {
        foreach ($this->testSet as $slashed) {
            $this->assertTrue(
                (new UrlWithTrailingSlashProcessor($slashed))->hasTrailingSlash()
            );
        }
    }

    /**
     * Test if already slashed URLs are detected
     */
    public function testComparisonIsNotSlashed()
    {
        foreach ($this->testSet as $unslashed => $slashed) {
            $this->assertFalse(
                (new UrlWithTrailingSlashProcessor($unslashed))->hasTrailingSlash()
            );
        }
    }

    /**
     * Test if excluded file types are really excluded
     */
    public function testExcludedFileTypes()
    {
        foreach ($this->testSetExcludedFiles as $unslashed => $slashed) {
            $this->assertEquals(
                $slashed,
                (new UrlWithTrailingSlash($unslashed, ['php']))->getUrlWithSlash()
            );
        }
    }
}
