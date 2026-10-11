<?php

namespace App\Support;

/**
 * Keep menu category links on the current storefront, regardless of whether
 * the admin menu was saved with a production-domain absolute URL.
 *
 * External links and non-category links are intentionally not rewritten.
 */
final class CategoryMenuUrl
{
    /**
     * @param mixed $link URL saved by the menu package
     * @return string
     */
    public static function resolve($link)
    {
        if (!is_string($link) || trim($link) === '') {
            return '#';
        }

        $link = trim($link);
        $parts = parse_url($link);

        if ($parts === false) {
            return $link;
        }

        $scheme = strtolower($parts['scheme'] ?? '');
        if ($scheme !== '' && !in_array($scheme, ['http', 'https'], true)) {
            return $link;
        }

        $host = strtolower($parts['host'] ?? '');
        $storefrontHosts = ['leatherket.com', 'www.leatherket.com', 'localhost', '127.0.0.1'];

        if ($host !== '' && !in_array($host, $storefrontHosts, true)
            && $host !== strtolower(request()->getHost())) {
            return $link;
        }

        $path = $parts['path'] ?? '';
        if (!preg_match('~^/?category/([^/]+)/?$~uD', $path, $matches)) {
            return $link;
        }

        $slug = rawurldecode($matches[1]);
        if ($slug === '' || strpos($slug, '/') !== false || strpos($slug, "\0") !== false) {
            return $link;
        }

        // absolute=false prevents APP_URL/old domains from appearing in hrefs.
        $localUrl = route('category', ['slug' => $slug], false);

        if (isset($parts['query'])) {
            $localUrl .= '?' . $parts['query'];
        }
        if (isset($parts['fragment'])) {
            $localUrl .= '#' . $parts['fragment'];
        }

        return $localUrl;
    }
}
