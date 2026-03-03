<?php $__env->startSection('title', 'Bulk Attendance Entry'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-12">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="card mb-6">
            <div class="card-body">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">📝 Bulk Attendance Entry</h1>
                <p class="text-slate-600 dark:text-slate-400 mb-6">Select a training session, then mark attendance for all players in that session.</p>

                
                <div class="mb-8">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Select Training Session</label>
                    <select id="sessionSelect" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                        <option value="">Choose a session...</option>
                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($session->id); ?>"
                                    data-branch="<?php echo e($session->branch_id); ?>"
                                    data-group="<?php echo e($session->group_id); ?>"
                                    data-date="<?php echo e($session->date->format('M d, Y')); ?>"
                                    data-time="<?php echo e($session->start_time); ?> - <?php echo e($session->end_time); ?>"
                                    data-location="<?php echo e($session->location); ?>"
                                    data-coach="<?php echo e(optional($session->coach)->name); ?>">
                                <?php echo e($session->date->format('M d, Y')); ?> • <?php echo e($session->start_time); ?> • <?php echo e($session->location); ?> • <?php echo e(optional($session->branch)->name); ?> / <?php echo e(optional($session->group)->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div id="sessionInfo" class="hidden bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-4 mb-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">Selected Session</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div><span class="font-semibold">Date:</span> <span id="infoDate"></span></div>
                        <div><span class="font-semibold">Time:</span> <span id="infoTime"></span></div>
                        <div><span class="font-semibold">Location:</span> <span id="infoLocation"></span></div>
                        <div><span class="font-semibold">Coach:</span> <span id="infoCoach"></span></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div id="studentsContainer" class="hidden">
            <form method="POST" action="<?php echo e(route('admin.student-attendance.bulk.store')); ?>" id="bulkAttendanceForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="training_session_id" id="sessionIdInput">

                <div class="card mb-6">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Players Attendance</h2>
                            <div class="flex gap-2">
                                <button type="button" onclick="markAllPresentAndSubmit()" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                                    Mark All Present & Save
                                </button>
                                <button type="button" onclick="markAllAbsent()" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                            </div>
                        </div>

                        <div id="studentsList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Players will be loaded here -->
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                        💾 Save All Attendance
                    </button>
                </div>
            </form>
        </div>

        <div id="loadingMessage" class="hidden card">
            <div class="card-body text-center py-12">
                <div class="text-4xl mb-4">⏳</div>

                                    <?php $__env->startPush('scripts'); ?>
                                    <script>
                                    // Auto-select most recent session on page load
                                    window.addEventListener('DOMContentLoaded', function() {
                                        const sessionSelect = document.getElementById('sessionSelect');
                                        if (sessionSelect.options.length > 1) {
                                            sessionSelect.selectedIndex = 1; // Select the first real session
                                            sessionSelect.dispatchEvent(new Event('change'));
                                        }
                                    });

                <p class="text-slate-600">Loading students...</p>
            </div>
        </div>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('sessionSelect').addEventListener('change', function() {
    const sessionId = this.value;
    const selectedOption = this.options[this.selectedIndex];

    if (!sessionId) {
        document.getElementById('sessionInfo').classList.add('hidden');
        document.getElementById('studentsContainer').classList.add('hidden');
        return;
    }

    // Display session info
    document.getElementById('infoDate').textContent = selectedOption.dataset.date;
    document.getElementById('infoTime').textContent = selectedOption.dataset.time;
    document.getElementById('infoLocation').textContent = selectedOption.dataset.location;
    document.getElementById('infoCoach').textContent = selectedOption.dataset.coach;
    document.getElementById('sessionInfo').classList.remove('hidden');

    // Set hidden input
    document.getElementById('sessionIdInput').value = sessionId;

    // Load students
    loadStudents(selectedOption.dataset.branch, selectedOption.dataset.group);
});

function loadStudents(branchId, groupId) {
    document.getElementById('loadingMessage').classList.remove('hidden');
    document.getElementById('studentsContainer').classList.add('hidden');

    fetch(`/api/students?branch_id=${branchId}&group_id=${groupId}`)
        .then(response => response.json())
        .then(students => {
            const container = document.getElementById('studentsList');
            container.innerHTML = '';

            students.forEach((student, index) => {
                const card = `
                    <div class="bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-700 rounded-lg p-4">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-3">${student.first_name} ${student.second_name || ''}</h3>
                        <input type="hidden" name="attendance[${index}][student_id]" value="${student.id}">

                        <div class="mb-3">
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Status</label>
                            <select name="attendance[${index}][status]" class="student-status w-full border border-slate-300 dark:border-neutral-600 rounded px-2 py-1 text-sm dark:bg-neutral-800 dark:text-white" required>
                                <option value="present">✓ Present</option>
                                <option value="absent">✗ Absent</option>
                                <option value="late">⏰ Late</option>
                                <option value="excused">📝 Excused</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Notes</label>
                            <input type="text" name="attendance[${index}][notes]" placeholder="Optional notes..." class="w-full border border-slate-300 dark:border-neutral-600 rounded px-2 py-1 text-sm dark:bg-neutral-800 dark:text-white">
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });

            document.getElementById('loadingMessage').classList.add('hidden');
            document.getElementById('studentsContainer').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error loading students:', error);
            alert('Failed to load students. Please try again.');
            document.getElementById('loadingMessage').classList.add('hidden');
        });
}


function markAllPresentAndSubmit() {
    document.querySelectorAll('.student-status').forEach(select => {
        select.value = 'present';
    });
    // Submit the form automatically
    document.getElementById('bulkAttendanceForm').submit();
}

function markAllAbsent() {
    document.querySelectorAll('.student-status').forEach(select => {
        select.value = 'absent';
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\student-attendance\bulk-create.blade.php ENDPATH**/ ?>