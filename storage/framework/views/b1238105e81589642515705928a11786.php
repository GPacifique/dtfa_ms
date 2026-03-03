<?php
    $size = $size ?? 96; // default px
    $alt = $alt ?? ($name ?? 'Image');
    $classes = $class ?? 'rounded-md object-cover';

    // Resolve URL from path with safe fallbacks
    $url = null;
    $path = $path ?? null;

    if (!empty($path)) {
        // If path looks like a full URL
        if (preg_match('/^https?:\/\//i', $path)) {
            $url = $path;
        } else {
            // Try PhotoController route if it exists
            try {
                if (\Illuminate\Support\Facades\Route::has('photos.show')) {
                    $url = url(route('photos.show', ['path' => $path], false));
                }
            } catch (\Throwable $e) {
                $url = null;
            }

            // Fallback to storage URL with full domain
            if (!$url) {
                // Common storage locations
                $candidates = [
                    'storage/'.$path,
                    'public/storage/'.$path,
                    $path,
                ];
                foreach ($candidates as $candidate) {
                    $candidatePath = public_path($candidate);
                    if (is_file($candidatePath)) {
                        $url = url($candidate);
                        break;
                    }
                }
            }

            // If still no URL but path exists, try direct storage URL
            if (!$url) {
                $url = url('/storage/' . ltrim($path, '/'));
            }
        }
    }

    // Final fallback: UI Avatars for name
    if (!$url) {
        $initials = trim((string) ($name ?? 'User'));
        $encoded = urlencode($initials);
        $bg = $bg ?? '4f46e5';
        $color = $color ?? 'ffffff';
        $url = "https://ui-avatars.com/api/?name={$encoded}&background={$bg}&color={$color}&size=".max(64, (int) $size);
    }
?>

<img src="<?php echo e($url); ?>" alt="<?php echo e($alt); ?>" width="<?php echo e((int) $size); ?>" height="<?php echo e((int) $size); ?>" class="<?php echo e($classes); ?>"
     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($name ?? 'User')); ?>&background=<?php echo e($bg ?? '4f46e5'); ?>&color=<?php echo e($color ?? 'ffffff'); ?>&size=<?php echo e(max(64, (int) ($size ?? 96))); ?>';" />
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\components\image.blade.php ENDPATH**/ ?>