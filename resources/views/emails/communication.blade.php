<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $communication->title }}</title>
</head>
<body>
  <h2>{{ $communication->title }}</h2>
  <div>{!! nl2br(e($communication->body)) !!}</div>

  @if($communication->minutes)
    <h3>Minutes</h3>
    <div>{!! nl2br(e($communication->minutes)) !!}</div>
  @endif

  <p>--</p>
  <p>Sent by: {{ optional($communication->sender)->name ?? 'DTFA' }}</p>
</body>
</html>
