@php
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
@endphp

<img src="{{ $url }}" alt="{{ $alt }}" width="{{ (int) $size }}" height="{{ (int) $size }}" class="{{ $classes }}"
     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($name ?? 'User') }}&background={{ $bg ?? '4f46e5' }}&color={{ $color ?? 'ffffff' }}&size={{ max(64, (int) ($size ?? 96)) }}';" />
