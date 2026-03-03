<div class="space-y-4">
    <div>
        <label class="block font-medium">Title</label>
        <input type="text" name="title" value="<?php echo e(old('title', $communication->title ?? '')); ?>" class="w-full border rounded px-3 py-2" required />
    </div>

    <div>
        <label class="block font-medium">Body</label>
        <textarea name="body" rows="6" class="w-full border rounded px-3 py-2"><?php echo e(old('body', $communication->body ?? '')); ?></textarea>
    </div>

    <div>
        <label class="block font-medium">Minutes (optional)</label>
        <textarea name="minutes" rows="4" class="w-full border rounded px-3 py-2"><?php echo e(old('minutes', $communication->minutes ?? '')); ?></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-medium">Activity Type</label>
            <input type="text" name="activity_type" value="<?php echo e(old('activity_type', $communication->activity_type ?? '')); ?>" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block font-medium">Audience</label>
            <select name="audience" class="w-full border rounded px-3 py-2">
                <option value="staff" <?php echo e((old('audience', $communication->audience ?? '')=='staff') ? 'selected' : ''); ?>>Staff</option>
                <option value="all" <?php echo e((old('audience', $communication->audience ?? '')=='all') ? 'selected' : ''); ?>>All users</option>
            </select>
        </div>
    </div>

    <div class="pt-2">
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="send_now" value="1" <?php echo e(old('send_now') ? 'checked' : ''); ?> class="rounded border-slate-300">
            <span class="text-sm text-slate-700">Send now (bypass queue)</span>
        </label>
        <p class="text-xs text-slate-500 mt-1">Checked: deliver immediately in this request. Unchecked: queue and deliver via worker.</p>
    </div>
</div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\communications\_form.blade.php ENDPATH**/ ?>