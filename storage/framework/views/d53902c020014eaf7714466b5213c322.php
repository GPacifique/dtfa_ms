<?php $__env->startComponent('mail::message'); ?>

# Welcome to DTFA, <?php echo new \Illuminate\Support\EncodedHtmlString($student->first_name); ?>!

We’re excited to confirm your registration.

<?php $__env->startComponent('mail::panel'); ?>
**Student:** <?php echo new \Illuminate\Support\EncodedHtmlString($student->first_name); ?> <?php echo new \Illuminate\Support\EncodedHtmlString($student->second_name); ?>

**Group:** <?php echo new \Illuminate\Support\EncodedHtmlString(optional($student->group)->name ?? '—'); ?>

**Branch:** <?php echo new \Illuminate\Support\EncodedHtmlString(optional($student->branch)->name ?? '—'); ?>

**Status:** <?php echo new \Illuminate\Support\EncodedHtmlString(ucfirst($student->status ?? 'active')); ?>

<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => config('app.url')]); ?>
Visit DTFA Portal
<?php echo $__env->renderComponent(); ?>

If you have any questions, just reply to this email.

Thanks,
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?> Team

<?php $__env->slot('subcopy'); ?>
If you’re having trouble clicking the "Visit DTFA Portal" button, copy and paste the URL below into your web browser: <?php echo new \Illuminate\Support\EncodedHtmlString(config('app.url')); ?>

<?php $__env->endSlot(); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/emails/students/registered.blade.php ENDPATH**/ ?>