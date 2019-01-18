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
/**
 * Class SoneriticsTrailingSlashConfiguration
 * Contains configuration for the plugin.
 */
class SoneriticsTrailingSlashConfiguration
{
    /**
     * @var array The areas this plugin will run in
     */
    public static $actOnAreas = ['C'];

    /**
     * @var bool Should the plugin run on AJAX requests
     */
    public static $actOnAjax = false;

    /**
     * @var bool Should the plugin run on POST requests
     */
    public static $actOnPost = false;

    /**
     * @var array File extensions that need to be excluded
     */
    public static $excludeFileTypes = ['php', 'htm', 'html'];
}
