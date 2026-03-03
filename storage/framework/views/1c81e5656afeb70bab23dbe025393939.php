<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo e($communication->title); ?></title>
</head>
<body>
  <h2><?php echo e($communication->title); ?></h2>
  <div><?php echo nl2br(e($communication->body)); ?></div>

  <?php if($communication->minutes): ?>
    <h3>Minutes</h3>
    <div><?php echo nl2br(e($communication->minutes)); ?></div>
  <?php endif; ?>

  <p>--</p>
  <p>Sent by: <?php echo e(optional($communication->sender)->name ?? 'DTFA'); ?></p>
</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\emails\communication.blade.php ENDPATH**/ ?>