<?php
    $editing = isset($game);
    $isScheduled = !$editing || $game->status === 'scheduled';
    $canReport = $editing && ($game->status === 'in_progress' || $game->status === 'completed');
?>

<form action="<?php echo e($editing ? route('admin.games.update', $game) : route('admin.games.store')); ?>" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <!-- Status hidden: automated by scheduler -->

    <!-- SECTION 1: MATCH CREATION FIELDS (Always visible for creation, visible for scheduled matches) -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Match Details
        </h2>

        <!-- Sports Discipline -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sports Discipline *</label>
            <select name="discipline" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <option value="">Select discipline</option>
                <option value="Football" <?php echo e($editing && $game->discipline=='Football' ? 'selected' : ''); ?>>Football</option>
                <option value="Basketball" <?php echo e($editing && $game->discipline=='Basketball' ? 'selected' : ''); ?>>Basketball</option>
            </select>
            <?php $__errorArgs = ['discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Home Team -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Home Team *</label>
                <input type="text" name="home_team" value="<?php echo e($editing ? $game->home_team : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['home_team'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Home Team Color</label>
                <input type="color" name="home_color" value="<?php echo e($editing ? $game->home_color : '#ffffff'); ?>" class="w-full border rounded-lg h-10" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['home_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Away Team -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Away Team *</label>
                <input type="text" name="away_team" value="<?php echo e($editing ? $game->away_team : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['away_team'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Away Team Color</label>
                <input type="color" name="away_color" value="<?php echo e($editing ? $game->away_color : '#ffffff'); ?>" class="w-full border rounded-lg h-10" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['away_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Objective -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Objective of the Match</label>
            <textarea name="objective" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" rows="3" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>><?php echo e($editing ? $game->objective : ''); ?></textarea>
            <?php $__errorArgs = ['objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Date and Time -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date *</label>
                <input type="date" name="date" value="<?php echo e($editing ? $game->date : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Time of Game *</label>
                <input type="time" name="time" value="<?php echo e($editing ? $game->time : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Departure Time</label>
                <input type="time" name="departure_time" value="<?php echo e($editing ? $game->departure_time : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expected Finish Time</label>
                <input type="time" name="expected_finish_time" value="<?php echo e($editing ? $game->expected_finish_time : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['expected_finish_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Game Category *</label>
                <select name="category" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                    <option value="">Select category</option>
                    <option value="In house" <?php echo e($editing && $game->category=='In house' ? 'selected' : ''); ?>>In House</option>
                    <option value="Friendly" <?php echo e($editing && $game->category=='Friendly' ? 'selected' : ''); ?>>Friendly</option>
                    <option value="League" <?php echo e($editing && $game->category=='League' ? 'selected' : ''); ?>>League</option>
                </select>
                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Transport, Venue, Age Group, Country, City, Base, Gender -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Transport *</label>
                <select name="transport" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                    <option value="">Select transport</option>
                    <option value="Self" <?php echo e($editing && $game->transport=='Self' ? 'selected' : ''); ?>>Self</option>
                    <option value="Group" <?php echo e($editing && $game->transport=='Group' ? 'selected' : ''); ?>>Group</option>
                </select>
                <?php $__errorArgs = ['transport'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue *</label>
                <input type="text" name="venue" value="<?php echo e($editing ? $game->venue : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['venue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Age Group *</label>
                <select name="age_group" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                    <option value="">Select age group</option>
                    <option value="u18" <?php echo e($editing && $game->age_group=='u18' ? 'selected' : ''); ?>>U18</option>
                    <option value="u16" <?php echo e($editing && $game->age_group=='u16' ? 'selected' : ''); ?>>U16</option>
                    <option value="u14" <?php echo e($editing && $game->age_group=='u14' ? 'selected' : ''); ?>>U14</option>
                    <option value="u12" <?php echo e($editing && $game->age_group=='u12' ? 'selected' : ''); ?>>U12</option>
                </select>
                <?php $__errorArgs = ['age_group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country *</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                    <option value="">Select country</option>
                    <option value="Rwanda" <?php echo e($editing && $game->country=='Rwanda' ? 'selected' : ''); ?>>Rwanda</option>
                    <option value="Tanzania" <?php echo e($editing && $game->country=='Tanzania' ? 'selected' : ''); ?>>Tanzania</option>
                </select>
                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                <input type="text" name="city" value="<?php echo e($editing ? $game->city : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Base</label>
                <input type="text" name="base" value="<?php echo e($editing ? $game->base : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['base'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender *</label>
                <select name="gender" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                    <option value="">Select gender</option>
                    <option value="Male" <?php echo e($editing && $game->gender=='Male' ? 'selected' : ''); ?>>Male</option>
                    <option value="Female" <?php echo e($editing && $game->gender=='Female' ? 'selected' : ''); ?>>Female</option>
                    <option value="Mixed" <?php echo e($editing && $game->gender=='Mixed' ? 'selected' : ''); ?>>Mixed</option>
                </select>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Staff Selection with Searchable Multi-Select -->
        <div class="mb-4" x-data="multiSelect({
            items: <?php echo e($staffs->map(fn($s) => ['id' => $s->id, 'name' => $s->first_name . ' ' . $s->last_name])->toJson()); ?>,
            selected: <?php echo e($editing ? json_encode($game->staff_ids ?? []) : '[]'); ?>,
            inputName: 'staff_ids[]'
        })">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Staff Assignment</label>
            <div class="relative">
                <div class="w-full min-h-[42px] border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 cursor-text flex flex-wrap gap-2" @click="open = true; $nextTick(() => $refs.search.focus())">
                    <template x-for="id in selectedIds" :key="id">
                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm rounded-md">
                            <span x-text="getItemName(id)"></span>
                            <button type="button" @click.stop="toggleItem(id)" class="hover:text-blue-600" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </span>
                    </template>
                    <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search staff..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
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
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="notify_staff" class="form-checkbox" <?php echo e($editing && $game->notify_staff ? 'checked' : ''); ?> <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Send Email Notification to Staff</span>
            </label>
        </div>

        <!-- Player Selection with Searchable Multi-Select -->
        <div class="mb-4" x-data="multiSelect({
            items: <?php echo e($players->map(fn($p) => ['id' => $p->id, 'name' => $p->first_name . ' ' . ($p->second_name ?? $p->last_name ?? '')])->toJson()); ?>,
            selected: <?php echo e($editing ? json_encode($game->player_ids ?? []) : '[]'); ?>,
            inputName: 'player_ids[]'
        })">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Player List (Students)</label>
            <div class="relative">
                <div class="w-full min-h-[42px] border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 cursor-text flex flex-wrap gap-2" @click="open = true; $nextTick(() => $refs.search.focus())">
                    <template x-for="id in selectedIds" :key="id">
                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm rounded-md">
                            <span x-text="getItemName(id)"></span>
                            <button type="button" @click.stop="toggleItem(id)" class="hover:text-green-600" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </span>
                    </template>
                    <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search players..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white" <?php echo e(!$isScheduled ? 'disabled' : ''); ?>>
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
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- SECTION 2: MATCH REPORTING FIELDS (Only visible when reporting) -->
    <?php if($canReport): ?>
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📊 Match Report
        </h2>

        <!-- Scores -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Home Team Score</label>
                <input type="number" name="home_score" value="<?php echo e($editing ? $game->home_score : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" min="0">
                <?php $__errorArgs = ['home_score'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Away Team Score</label>
                <input type="number" name="away_score" value="<?php echo e($editing ? $game->away_score : ''); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" min="0">
                <?php $__errorArgs = ['away_score'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Discipline Sanctions -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Yellow Cards - Players</label>
                <select name="yellow_cards_players[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($player->id); ?>" <?php echo e($editing && in_array($player->id, $game->yellow_cards_players ?? []) ? 'selected' : ''); ?>>
                            <?php echo e($player->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['yellow_cards_players'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Red Cards - Players</label>
                <select name="red_cards_players[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($player->id); ?>" <?php echo e($editing && in_array($player->id, $game->red_cards_players ?? []) ? 'selected' : ''); ?>>
                            <?php echo e($player->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['red_cards_players'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Yellow Cards - Staff</label>
                <select name="yellow_cards_staff[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>" <?php echo e($editing && in_array($staff->id, $game->yellow_cards_staff ?? []) ? 'selected' : ''); ?>>
                            <?php echo e($staff->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['yellow_cards_staff'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Red Cards - Staff</label>
                <select name="red_cards_staff[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>" <?php echo e($editing && in_array($staff->id, $game->red_cards_staff ?? []) ? 'selected' : ''); ?>>
                            <?php echo e($staff->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['red_cards_staff'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Incidence & Technical Feedback -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Incidence/Events</label>
            <textarea name="incidence" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" rows="4"><?php echo e($editing ? $game->incidence : ''); ?></textarea>
            <?php $__errorArgs = ['incidence'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Technical Feedback</label>
            <textarea name="technical_feedback" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" rows="4"><?php echo e($editing ? $game->technical_feedback : ''); ?></textarea>
            <?php $__errorArgs = ['technical_feedback'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Submit Button -->
    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-neutral-700">
        <a href="<?php echo e(route('admin.games.index')); ?>" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
            <?php echo e($editing ? 'Update Match' : 'Create Match'); ?>

        </button>
    </div>
</form>

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
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\games\_form.blade.php ENDPATH**/ ?>