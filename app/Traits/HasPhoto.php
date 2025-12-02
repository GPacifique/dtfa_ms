<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasPhoto
{
    /**
     * Get the photo URL with proper fallbacks.
     *
     * This method provides a consistent strategy for fetching image URLs:
     * 1. Try to get URL from storage disk (works with both local and cloud storage)
     * 2. Fallback to asset path if storage driver fails
     * 3. Generate UI Avatar with initials if no photo exists
     *
     * @param string|null $path The photo path from database
     * @param string $initials The initials for fallback avatar
     * @param string $backgroundColor Hex color for avatar background (without #)
     * @return string The complete photo URL
     */
    protected function getPhotoUrlFromPath(?string $path, string $initials, string $backgroundColor = '3b82f6'): string
    {
        if ($path) {
            // Try storage disk URL first (works with S3, local, etc.)
            try {
                return Storage::disk('public')->url(ltrim($path, '/'));
            } catch (\Throwable $e) {
                // Fallback to asset path for local storage
                return asset('storage/' . ltrim($path, '/'));
            }
        }

        // Generate UI Avatar with initials as fallback
        return $this->generateAvatarUrl($initials, $backgroundColor);
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
