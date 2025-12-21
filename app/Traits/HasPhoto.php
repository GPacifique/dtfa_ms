<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasPhoto
{
    /**
     * Get the photo URL with proper fallbacks.
     *
     * This method provides a consistent strategy for fetching image URLs:
     * 1. Use PhotoController routes for better control and compatibility
     * 2. Generate UI Avatar with initials if no photo exists
     *
     * PhotoController handles:
     * - Local storage (both XAMPP and production)
     * - Cloud storage (S3, Cloudinary)
     * - Proper MIME types and caching
     * - Missing file handling
     *
     * @param string|null $path The photo path from database
     * @param string $initials The initials for fallback avatar
     * @param string $backgroundColor Hex color for avatar background (without #)
     * @return string The complete photo URL
     */
    protected function getPhotoUrlFromPath(?string $path, string $initials, string $backgroundColor = '3b82f6'): string
    {
        // 1. Check if file exists in public storage
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        // 2. Fallback to SVG Avatar
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
    <rect width="128" height="128" fill="#f1f5f9"/>
    <text x="50%" y="50%" font-family="ui-sans-serif, system-ui, sans-serif" font-size="52" font-weight="600" fill="#64748b" text-anchor="middle" dy=".35em">{$initials}</text>
</svg>
SVG;
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }


    /**
     * Generate a UI Avatar URL with initials.
     *
     * @param string $initials User initials (1-3 characters)
     * @param string $backgroundColor Hex color without #
     * @param string $foregroundColor Hex color without #
     * @param int $size Avatar size in pixels
     * @return string Complete avatar URL
     */
    protected function generateAvatarUrl(
        string $initials,
        string $backgroundColor = '3b82f6',
        string $foregroundColor = 'ffffff',
        int $size = 128
    ): string {
        return sprintf(
            'https://ui-avatars.com/api/?name=%s&background=%s&color=%s&size=%d&bold=true',
            urlencode($initials),
            $backgroundColor,
            $foregroundColor,
            $size
        );
    }

    /**
     * Check if the model has a photo uploaded.
     *
     * @return bool
     */
    public function hasPhoto(): bool
    {
        $photoField = $this->getPhotoFieldName();
        return !empty($this->$photoField);
    }

    /**
     * Get the photo field name for this model.
     * Override this in your model if using a different field name.
     *
     * @return string
     */
    protected function getPhotoFieldName(): string
    {
        // Check common field names
        if (property_exists($this, 'photoFieldName')) {
            return $this->photoFieldName;
        }

        // Default field names
        return 'photo_path';
    }

    /**
     * Delete the photo file from storage.
     *
     * @return bool
     */
    public function deletePhoto(): bool
    {
        $photoField = $this->getPhotoFieldName();
        $path = $this->$photoField;

        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
