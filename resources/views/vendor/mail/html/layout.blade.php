<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $title ?? config('app.name') }}</title>
    <style>
        /* Basic Tailwind-like utility styles for email (inline-friendly minimal set) */
        .container { width: 100%; margin: 0 auto; padding: 0 16px; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .my-8 { margin-top: 32px; margin-bottom: 32px; }
        .rounded { border-radius: 6px; }
        .shadow { box-shadow: 0 4px 14px rgba(0,0,0,0.06); }
        .text-center { text-align: center; }
        .muted { color: #64748b; }
        .brand { color: #10b981; font-weight: 700; }
        .card { background: #ffffff; border: 1px solid #e2e8f0; }
        .p-6 { padding: 24px; }
        a.button { background: linear-gradient(135deg,#10b981,#059669); color: #fff; text-decoration: none; padding: 10px 16px; border-radius: 6px; display: inline-block; }
    </style>
</head>
<body style="background-color:#f1f5f9; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, 'Apple Color Emoji','Segoe UI Emoji'; color:#0f172a;">
    <div class="container mx-auto my-8" style="max-width:640px;">
        @include('vendor.mail.html.header')

        <div class="card rounded shadow p-6" style="margin-top:16px;">
            {{ $slot }}
        </div>

        @isset($subcopy)
            <div class="muted" style="font-size:12px; margin-top:16px;">
                {{ $subcopy }}
            </div>
        @endisset

        @include('vendor.mail.html.footer')
    </div>
</body>
</html>
