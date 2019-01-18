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
class UrlWithTrailingSlashProcessor
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var UrlWithTrailingSlash
     */
    private $urlWithTrailingSlash;

    /**
     * @var array Extensionsof files that must be excluded from trailing
     */
    private $excludes = [];

    /**
     * UrlWithTrailingSlashProcessor constructor.
     * @param string $url
     * @param array $excludes
     */
    public function __construct(string $url = null, array $excludes = [])
    {
        if (php_sapi_name() !== 'cli') {
            if ($url === null) {
                $s = 's';
                $url = "http{$s}://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }
        }

        if (empty($url)) {
            $url = '/';
        }

        $this->url = $url;
        $this->excludes = $excludes;
    }

    /**
     * Test if the URL already has a trailing slash
     * @return bool
     */
    public function hasTrailingSlash(): bool
    {
        return $this->getTrailingSlashURL()->getUrlWithSlash() === $this->url;
    }

    /**
     * Get a URL with trailing slash
     * @return UrlWithTrailingSlash
     */
    public function getTrailingSlashURL(): UrlWithTrailingSlash
    {
        if (empty($this->urlWithTrailingSlash)) {
            $this->urlWithTrailingSlash = new UrlWithTrailingSlash($this->url, $this->excludes);
        }

        return $this->urlWithTrailingSlash;
    }
}
