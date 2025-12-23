<?php

function check_balance($filepath) {
    $content = file_get_contents($filepath);
    $lines = explode("\n", $content);
    $stack = [];
    $errors = [];

    $directives = [
        '/@if\s*\(/' => 'if',
        '/@endif/' => 'endif',
        '/@role\s*\(/' => 'role',
        '/@endrole/' => 'endrole',
        '/@auth/' => 'auth',
        '/@endauth/' => 'endauth',
        '/@can\s*\(/' => 'can',
        '/@endcan/' => 'endcan',
        '/@foreach\s*\(/' => 'foreach',
        '/@endforeach/' => 'endforeach',
        '/@forelse\s*\(/' => 'forelse',
        '/@endforelse/' => 'endforelse',
        '/@push\s*\(/' => 'push',
        '/@endpush/' => 'endpush',
        '/@section\s*\(/' => 'section',
        '/@endsection/' => 'endsection',
    ];

    foreach ($lines as $i => $line) {
        $line_num = $i + 1;
        // Remove comments
        $line = preg_replace('/\{\{--.*?--\}\}/', '', $line);
        
        // Find all directives in the line
        $matches = [];
        foreach ($directives as $pattern => $name) {
            if (preg_match_all($pattern, $line, $m, PREG_OFFSET_CAPTURE)) {
                foreach ($m[0] as $match) {
                    $matches[] = ['name' => $name, 'offset' => $match[1]];
                }
            }
        }

        // Sort matches by offset to process them in order
        usort($matches, function($a, $b) {
            return $a['offset'] - $b['offset'];
        });

        foreach ($matches as $match) {
            $name = $match['name'];
            
            // Special case for @section
            if ($name === 'section') {
                // Check if it's @section('name', 'content') which is self-closing
                // This is a naive check, assuming single line
                if (preg_match('/@section\s*\(\s*[\'"][^\'"]+[\'"]\s*,\s*[\'"][^\'"]+[\'"]\s*\)/', $line)) {
                    continue;
                }
                 if (preg_match('/@section\s*\(\s*[\'"][^\'"]+[\'"]\s*,\s*[^)]+\)/', $line)) {
                    continue;
                }
            }

            if (strpos($name, 'end') === 0) {
                if (empty($stack)) {
                    $errors[] = "Line $line_num: Unexpected $name";
                } else {
                    $last = array_pop($stack);
                    $expected = substr($name, 3); // remove 'end'
                    if ($last['name'] != $expected) {
                        $errors[] = "Line $line_num: Found $name, expected end{$last['name']} (opened at {$last['line']})";
                        // Put it back if it's a mismatch? No, assume we closed the wrong one or missed one.
                    }
                }
            } else {
                $stack[] = ['name' => $name, 'line' => $line_num];
            }
        }
    }

    if (!empty($stack)) {
        foreach ($stack as $item) {
            $errors[] = "Unclosed {$item['name']} opened at line {$item['line']}";
        }
    }

    return $errors;
}

echo "Checking sidebar.blade.php...\n";
$errors = check_balance('resources/views/layouts/sidebar.blade.php');
foreach ($errors as $e) {
    echo "$e\n";
}

echo "\nChecking app.blade.php...\n";
$errors = check_balance('resources/views/layouts/app.blade.php');
foreach ($errors as $e) {
    echo "$e\n";
}

echo "\nChecking dashboard.blade.php...\n";
$errors = check_balance('resources/views/admin/dashboard.blade.php');
foreach ($errors as $e) {
    echo "$e\n";
}
