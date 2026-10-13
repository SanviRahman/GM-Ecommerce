<?php

namespace App\Support;

/**
 * Generate public upload URLs for both deployment layouts:
 * - php artisan serve: web root is <project>/public
 * - legacy cPanel: web root is <project>, uploads are in <project>/public
 *
 * Only resolves project-owned uploaded media; it never reads user-supplied
 * absolute URLs or filesystem paths.
 */
final class PublicMedia
{
    /**
     * Prefer the untouched image stored by the media uploader at public/<name>.
     * Product/thumbnail copies can be cropped squares, losing portrait details.
     * Products without an original keep the existing product/<name> fallback.
     */
    public static function productOriginalUrl($imageName)
    {
        $imageName = basename(str_replace('\\', '/', (string) $imageName));

        // Image names are internal filenames, never paths or remote URLs.
        if (! preg_match('/\A[a-zA-Z0-9_.-]+\.(?:jpg|jpeg|png|webp|gif)\z/i', $imageName)
            || $imageName === '.' || $imageName === '..') {
            return self::url('images/clear.png');
        }

        if (is_file(public_path($imageName))) {
            return self::url($imageName);
        }

        return self::url('product/' . $imageName);
    }

    public static function url($relativePath)
    {
        $relativePath = str_replace('\\', '/', (string) $relativePath);
        $relativePath = ltrim($relativePath, '/');

        // Accept old values stored with a public/ prefix.
        if (strpos($relativePath, 'public/') === 0) {
            $relativePath = substr($relativePath, 7);
        }

        // Prevent path traversal and unexpected protocols.
        if ($relativePath === '' || preg_match('~(^|/)\.\.?(/|$)|://|[\x00-\x1f]~', $relativePath)) {
            return asset('images/clear.png');
        }

        $publicRoot = realpath(public_path());
        $documentRoot = realpath((string) request()->server('DOCUMENT_ROOT', ''));
        $servedFromPublic = $publicRoot && $documentRoot &&
            str_replace('\\', '/', $publicRoot) === str_replace('\\', '/', $documentRoot);

        return asset(($servedFromPublic ? '' : 'public/') . $relativePath);
    }
}
