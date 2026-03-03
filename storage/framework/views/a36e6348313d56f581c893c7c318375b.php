<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4"><?php echo e(__('app.create')); ?> <?php echo e(__('app.player')); ?></h2>

        <form action="<?php echo e(route('admin.players.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Student Selection with Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"><?php echo e(__('app.select_from_players')); ?></label>
                    <div x-data="{
                        open: false,
                        search: '',
                        selected: null,
                        selectedName: '',
                        students: <?php echo e(Js::from($students->map(fn($s) => ['id' => $s->id, 'name' => $s->first_name . ' ' . $s->second_name, 'first_name' => $s->first_name, 'last_name' => $s->second_name]))); ?>,
                        get filteredStudents() {
                            if (!this.search) return this.students;
                            return this.students.filter(s => s.name.toLowerCase().includes(this.search.toLowerCase()));
                        },
                        selectStudent(student) {
                            this.selected = student.id;
                            this.selectedName = student.name;
                            this.open = false;
                            this.search = '';
                            document.getElementById('first_name').value = student.first_name;
                            document.getElementById('last_name').value = student.last_name || '';
                        },
                        clearSelection() {
                            this.selected = null;
                            this.selectedName = '';
                        }
                    }" class="relative">
                        <input type="hidden" name="student_id" :value="selected">

                        <!-- Dropdown Trigger -->
                        <div @click="open = !open" class="border border-slate-300 dark:border-slate-600 rounded-lg p-3 cursor-pointer bg-white dark:bg-slate-800 flex items-center justify-between">
                            <span x-show="!selected" class="text-slate-500">-- <?php echo e(__('app.select_player_optional')); ?> --</span>
                            <span x-show="selected" x-text="selectedName" class="text-slate-800 dark:text-slate-200"></span>
                            <div class="flex items-center gap-2">
                                <button type="button" x-show="selected" @click.stop="clearSelection()" class="text-slate-400 hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                                <svg class="w-5 h-5 text-slate-400" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Dropdown Panel -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg shadow-lg max-h-64 overflow-hidden">
                            <!-- Search Input -->
                            <div class="p-2 border-b border-slate-200 dark:border-slate-700">
                                <input type="text" x-model="search" @click.stop placeholder="<?php echo e(__('app.search')); ?>..." class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <!-- Options List -->
                            <div class="max-h-48 overflow-y-auto">
                                <template x-for="student in filteredStudents" :key="student.id">
                                    <div @click="selectStudent(student)" class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer text-slate-800 dark:text-slate-200" :class="{'bg-indigo-100 dark:bg-slate-600': selected === student.id}">
                                        <span x-text="student.name"></span>
                                    </div>
                                </template>
                                <div x-show="filteredStudents.length === 0" class="px-4 py-2 text-slate-500 text-center">
                                    <?php echo e(__('app.no_records')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-1"><?php echo e(__('app.select_player_hint')); ?></p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"><?php echo e(__('app.first_name')); ?> *</label>
                    <input type="text" id="first_name" name="first_name" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg p-3 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200" value="<?php echo e(old('first_name')); ?>" required>
                    <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"><?php echo e(__('app.last_name')); ?></label>
                    <input type="text" id="last_name" name="last_name" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg p-3 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200" value="<?php echo e(old('last_name')); ?>">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"><?php echo e(__('app.team')); ?></label>
                    <select name="team_id" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg p-3 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200">
                        <option value="">-- <?php echo e(__('app.none')); ?> --</option>
                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($team->id); ?>" <?php echo e(old('team_id') == $team->id ? 'selected' : ''); ?>><?php echo e($team->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"><?php echo e(__('app.position')); ?></label>
                    <input type="text" name="position" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg p-3 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200" value="<?php echo e(old('position')); ?>">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"><?php echo e(__('app.jersey_number')); ?></label>
                    <input type="number" name="number" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg p-3 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200" value="<?php echo e(old('number')); ?>">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="btn btn-primary">✅ <?php echo e(__('app.save')); ?></button>
                <a href="<?php echo e(route('admin.players.index')); ?>" class="btn btn-secondary"><?php echo e(__('app.cancel')); ?></a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\players\create.blade.php ENDPATH**/ ?>