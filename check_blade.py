
import re

def check_balance(filepath):
    with open(filepath, 'r') as f:
        lines = f.readlines()

    stack = []
    errors = []

    # Regex for directives
    # We care about @if, @else, @elseif, @endif
    # @role, @endrole
    # @auth, @endauth
    # @can, @endcan
    # @foreach, @endforeach
    # @forelse, @empty, @endforelse
    # @push, @endpush
    # @section, @endsection (though section can be inline)

    # Simplified check for @if/@endif balance

    directives = [
        (r'@if\s*\(', 'if'),
        (r'@endif', 'endif'),
        (r'@role\s*\(', 'role'),
        (r'@endrole', 'endrole'),
        (r'@auth', 'auth'),
        (r'@endauth', 'endauth'),
        (r'@can\s*\(', 'can'),
        (r'@endcan', 'endcan'),
        (r'@foreach\s*\(', 'foreach'),
        (r'@endforeach', 'endforeach'),
        (r'@forelse\s*\(', 'forelse'),
        (r'@endforelse', 'endforelse'),
        (r'@push\s*\(', 'push'),
        (r'@endpush', 'endpush'),
    ]

    for i, line in enumerate(lines):
        line_num = i + 1
        # Remove comments
        line = re.sub(r'\{\{--.*?--\}\}', '', line)

        for pattern, name in directives:
            matches = re.finditer(pattern, line)
            for match in matches:
                if name.startswith('end'):
                    if not stack:
                        errors.append(f"Line {line_num}: Unexpected {name}")
                    else:
                        last = stack.pop()
                        expected = name[3:] # remove 'end'
                        if last['name'] != expected:
                            # Special case: forelse can be closed by endforelse, but empty is in between
                            # For now, just check strict matching
                            errors.append(f"Line {line_num}: Found {name}, expected end{last['name']} (opened at {last['line']})")
                else:
                    stack.append({'name': name, 'line': line_num})

    if stack:
        for item in stack:
            errors.append(f"Unclosed {item['name']} opened at line {item['line']}")

    return errors

print("Checking sidebar.blade.php...")
errors = check_balance(r'c:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\layouts\sidebar.blade.php')
for e in errors:
    print(e)

print("\nChecking app.blade.php...")
errors = check_balance(r'c:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\layouts\app.blade.php')
for e in errors:
    print(e)

print("\nChecking dashboard.blade.php...")
errors = check_balance(r'c:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\dashboard.blade.php')
for e in errors:
    print(e)
