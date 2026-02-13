<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Prepare Match','subtitle' => 'Schedule and configure match details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Prepare Match','subtitle' => 'Schedule and configure match details']); ?>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.games.index')); ?>" class="btn-secondary">← Back to Matches</a>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $attributes = $__attributesOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__attributesOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $component = $__componentOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__componentOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-6">

    <form action="<?php echo e(isset($game) ? route('admin.games.update', $game) : route('admin.games.store')); ?>" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        <?php echo csrf_field(); ?>
        <?php if(isset($game)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <!-- Match Details Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-indigo-500">
                ⚽ Match Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sports Discipline -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sports Discipline *</label>
                    <select name="discipline" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select discipline</option>
                        <option value="Football" <?php echo e((isset($game) && $game->discipline=='Football') ? 'selected' : ''); ?>>⚽ Football</option>
                        <option value="Basketball" <?php echo e((isset($game) && $game->discipline=='Basketball') ? 'selected' : ''); ?>>🏀 Basketball</option>
                    </select>
                    <?php $__errorArgs = ['discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category *</label>
                    <select name="category" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select category</option>
                        <option value="In house" <?php echo e((isset($game) && $game->category=='In house') ? 'selected' : ''); ?>>🏠 In house</option>
                        <option value="Friendly" <?php echo e((isset($game) && $game->category=='Friendly') ? 'selected' : ''); ?>>🤝 Friendly</option>
                        <option value="League" <?php echo e((isset($game) && $game->category=='League') ? 'selected' : ''); ?>>🏆 League</option>
                    </select>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Teams Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-emerald-500">
                👥 Teams
            </h2>

            <!-- Home Team -->
            <div class="mb-6 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <h3 class="font-semibold text-lg mb-4 text-blue-900 dark:text-blue-200">🏠 Home Team</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Name *</label>
                        <input type="text" name="home_team" value="<?php echo e($game->home_team ?? ''); ?>" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <?php $__errorArgs = ['home_team'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                            Team Color
                            <span class="w-6 h-6 rounded-full shadow-inner border-2 border-white" style="background-color: <?php echo e($game->home_color ?? '#1E40AF'); ?>" id="home-color-preview"></span>
                        </label>
                        <input type="color" name="home_color" value="<?php echo e($game->home_color ?? '#1E40AF'); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg h-[50px] cursor-pointer" onchange="document.getElementById('home-color-preview').style.backgroundColor = this.value">
                        <?php $__errorArgs = ['home_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Away Team -->
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-lg">
                <h3 class="font-semibold text-lg mb-4 text-red-900 dark:text-red-200">✈️ Away Team</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Name *</label>
                        <input type="text" name="away_team" value="<?php echo e($game->away_team ?? ''); ?>" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <?php $__errorArgs = ['away_team'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                            Team Color
                            <span class="w-6 h-6 rounded-full shadow-inner border-2 border-white" style="background-color: <?php echo e($game->away_color ?? '#DC2626'); ?>" id="away-color-preview"></span>
                        </label>
                        <input type="color" name="away_color" value="<?php echo e($game->away_color ?? '#DC2626'); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg h-[50px] cursor-pointer" onchange="document.getElementById('away-color-preview').style.backgroundColor = this.value">
                        <?php $__errorArgs = ['away_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-purple-500">
                📅 Schedule
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Match Date *</label>
                    <input type="date" name="date" value="<?php echo e(isset($game) && $game->date ? $game->date->format('Y-m-d') : ''); ?>" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Game Time *</label>
                    <input type="time" name="time" value="<?php echo e($game->time ?? ''); ?>" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Departure Time</label>
                    <input type="time" name="departure_time" value="<?php echo e($game->departure_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Expected Finish</label>
                    <input type="time" name="expected_finish_time" value="<?php echo e($game->expected_finish_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['expected_finish_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Venue & Logistics Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-amber-500">
                📍 Venue & Logistics
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Venue *</label>
                    <input type="text" name="venue" value="<?php echo e($game->venue ?? ''); ?>" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['venue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                    <select name="country" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="Rwanda" <?php echo e((isset($game) && $game->country=='Rwanda') ? 'selected' : ''); ?>>🇷🇼 Rwanda</option>
                        <option value="Tanzania" <?php echo e((isset($game) && $game->country=='Tanzania') ? 'selected' : ''); ?>>🇹🇿 Tanzania</option>
                    </select>
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">City</label>
                    <input type="text" name="city" value="<?php echo e($game->city ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Base</label>
                    <input type="text" name="base" value="<?php echo e($game->base ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['base'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Transport</label>
                    <select name="transport" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="Self" <?php echo e((isset($game) && $game->transport=='Self') ? 'selected' : ''); ?>>🚗 Self</option>
                        <option value="Group" <?php echo e((isset($game) && $game->transport=='Group') ? 'selected' : ''); ?>>🚌 Group</option>
                    </select>
                    <?php $__errorArgs = ['transport'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Age Group</label>
                    <div class="flex flex-wrap gap-2">
                        <?php for($i = 4; $i <= 18; $i++): ?>
                            <label class="flex items-center">
                                <input type="checkbox" name="age_group[]" value="<?php echo e($i); ?>" class="form-checkbox" <?php if(is_array(old('age_group', $game->age_group ?? [])) && in_array($i, old('age_group', $game->age_group ?? []))): ?> checked <?php endif; ?>>
                                <span class="ml-2"><?php echo e($i); ?></span>
                            </label>
                        <?php endfor; ?>
                    </div>
                    <?php $__errorArgs = ['age_group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Gender</label>
                    <select name="gender" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="Male" <?php echo e((isset($game) && $game->gender=='Male') ? 'selected' : ''); ?>>👨 Male</option>
                        <option value="Female" <?php echo e((isset($game) && $game->gender=='Female') ? 'selected' : ''); ?>>👩 Female</option>
                        <option value="Mixed" <?php echo e((isset($game) && $game->gender=='Mixed') ? 'selected' : ''); ?>>👥 Mixed</option>
                    </select>
                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Objective Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                🎯 Match Objective
            </h2>
            <textarea name="objective" rows="3" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Describe the objective or purpose of this match..."><?php echo e($game->objective ?? ''); ?></textarea>
            <?php $__errorArgs = ['objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Staff & Players Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-pink-500">
                👔 Staff & Players
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Staff with Searchable Multi-Select -->
                <div x-data="multiSelect({
                    items: <?php echo e($staffs->map(fn($s) => ['id' => $s->id, 'name' => $s->first_name . ' ' . $s->last_name])->toJson()); ?>,
                    selected: <?php echo e(isset($game) ? json_encode($game->staff_ids ?? []) : '[]'); ?>,
                    inputName: 'staff_ids[]'
                })">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Staff</label>
                    <div class="relative">
                        <div class="w-full min-h-[160px] border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 cursor-text flex flex-wrap gap-2 content-start" @click="open = true; $nextTick(() => $refs.search.focus())">
                            <template x-for="id in selectedIds" :key="id">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm rounded-md">
                                    <span x-text="getItemName(id)"></span>
                                    <button type="button" @click.stop="toggleItem(id)" class="hover:text-blue-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </span>
                            </template>
                            <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search staff..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white">
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-neutral-800 border dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filteredItems" :key="item.id">
                                <div @click="toggleItem(item.id)" class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700 flex items-center justify-between">
                                    <span x-text="item.name" class="text-sm dark:text-white"></span>
                                    <svg x-show="selectedIds.includes(item.id)" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">No staff found</div>
                        </div>
                    </div>
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="staff_ids[]" :value="id">
                    </template>
                    <?php $__errorArgs = ['staff_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <div class="mt-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="notify_staff" value="1" <?php echo e((isset($game) && $game->notify_staff) ? 'checked' : ''); ?> class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">📧 Notify staff via email</span>
                        </label>
                    </div>
                </div>

                <!-- Players with Searchable Multi-Select -->
                <div x-data="multiSelect({
                    items: <?php echo e($players->map(fn($p) => ['id' => $p->id, 'name' => $p->first_name . ' ' . ($p->second_name ?? $p->last_name ?? '')])->toJson()); ?>,
                    selected: <?php echo e(isset($game) ? json_encode($game->player_ids ?? []) : '[]'); ?>,
                    inputName: 'player_ids[]'
                })">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Players (Students)</label>
                    <div class="relative">
                        <div class="w-full min-h-[160px] border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 cursor-text flex flex-wrap gap-2 content-start" @click="open = true; $nextTick(() => $refs.search.focus())">
                            <template x-for="id in selectedIds" :key="id">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm rounded-md">
                                    <span x-text="getItemName(id)"></span>
                                    <button type="button" @click.stop="toggleItem(id)" class="hover:text-green-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </span>
                            </template>
                            <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search players..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white">
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-neutral-800 border dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filteredItems" :key="item.id">
                                <div @click="toggleItem(item.id)" class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700 flex items-center justify-between">
                                    <span x-text="item.name" class="text-sm dark:text-white"></span>
                                    <svg x-show="selectedIds.includes(item.id)" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">No players found</div>
                        </div>
                    </div>
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="player_ids[]" :value="id">
                    </template>
                    <?php $__errorArgs = ['player_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="<?php echo e(route('admin.games.index')); ?>" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                <?php echo e(isset($game) ? '✅ Save' : '✅ Save'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('multiSelect', ({ items, selected, inputName }) => ({
            items: items,
            selectedIds: selected.map(id => parseInt(id)),
            search: '',
            open: false,

            get filteredItems() {
                if (!this.search) return this.items;
                const searchLower = this.search.toLowerCase();
                return this.items.filter(item => item.name.toLowerCase().includes(searchLower));
            },

            toggleItem(id) {
                id = parseInt(id);
                if (this.selectedIds.includes(id)) {
                    this.selectedIds = this.selectedIds.filter(i => i !== id);
                } else {
                    this.selectedIds.push(id);
                }
            },

            getItemName(id) {
                const item = this.items.find(i => i.id === parseInt(id));
                return item ? item.name : '';
            }
        }));
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/games/prepare.blade.php ENDPATH**/ ?>