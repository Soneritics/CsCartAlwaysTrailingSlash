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

class UrlWithTrailingSlash
{
    /**
     * @var string
     */
    private $originalUrl;

    /**
     * @var string
     */
    private $urlWithSlash;

    /**
     * UrlWithTrailingSlash constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->originalUrl = $url;
    }

    /**
     * Original URL
     * @return string
     */
    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    /**
     * URL with an ending slash
     * @return string
     */
    public function getUrlWithSlash(): string
    {
        $this->processUrl();
        return $this->urlWithSlash;
    }

    /**
     * Process the URL and transform into a slashed URL.
     * Only when it's not been generated already.
     */
    private function processUrl()
    {
        if (!empty($this->urlWithSlash)) {
            return;
        }

        $hasGetParameters = strpos($this->originalUrl, '?') !== false;
        $lastCharacter = substr($this->originalUrl, -1);

        if (!$hasGetParameters && $lastCharacter === '/') {
            $this->urlWithSlash = $this->originalUrl;
            return;
        }

        $urlWithoutGet = explode('?', $this->originalUrl)[0];
        $lastCharacterUrlWithoutGet = substr($urlWithoutGet, -1);

        if ($lastCharacterUrlWithoutGet === '/') {
            $this->urlWithSlash = $this->originalUrl;
            return;
        }

        $result = $urlWithoutGet . '/' . substr($this->originalUrl, strlen($urlWithoutGet));
        $this->urlWithSlash = $result;
    }
}
