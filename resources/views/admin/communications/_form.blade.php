<div class="space-y-4">
    <div>
        <label class="block font-medium">Title</label>
        <input type="text" name="title" value="{{ old('title', $communication->title ?? '') }}" class="w-full border rounded px-3 py-2" required />
    </div>

    <div>
        <label class="block font-medium">Body</label>
        <textarea name="body" rows="6" class="w-full border rounded px-3 py-2">{{ old('body', $communication->body ?? '') }}</textarea>
    </div>

    <div>
        <label class="block font-medium">Minutes (optional)</label>
        <textarea name="minutes" rows="4" class="w-full border rounded px-3 py-2">{{ old('minutes', $communication->minutes ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-medium">Activity Type</label>
            <input type="text" name="activity_type" value="{{ old('activity_type', $communication->activity_type ?? '') }}" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block font-medium">Audience</label>
            <select name="audience" class="w-full border rounded px-3 py-2">
                <option value="staff" {{ (old('audience', $communication->audience ?? '')=='staff') ? 'selected' : '' }}>Staff</option>
                <option value="all" {{ (old('audience', $communication->audience ?? '')=='all') ? 'selected' : '' }}>All users</option>
            </select>
        </div>
    </div>
</div>
