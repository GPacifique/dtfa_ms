<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => $game->home_team . ' vs ' . $game->away_team,'subtitle' => $game->date?->format('l, F d, Y') . ' at ' . ($game->time ?? '')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($game->home_team . ' vs ' . $game->away_team),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($game->date?->format('l, F d, Y') . ' at ' . ($game->time ?? ''))]); ?>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.games.index')); ?>" class="btn-secondary">← Back to Matches</a>
            <a href="<?php echo e(route('admin.games.edit', $game)); ?>" class="btn-outline">📝 Update Report</a>
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
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <!-- Top Match Card -->
    <div class="bg-white dark:bg-neutral-900 shadow-lg rounded-2xl overflow-hidden">
        <!-- Header/Status Strip -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-4 flex justify-between items-center text-white">
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                    <?php echo e($game->isCompleted() ? 'bg-green-500 text-white' : ($game->date && $game->date->isPast() ? 'bg-yellow-500 text-black' : 'bg-blue-500 text-white')); ?>">
                    <?php echo e($game->isCompleted() ? 'Completed' : ($game->date && $game->date->isPast() ? 'Pending Report' : 'Scheduled')); ?>

                </span>
                <span class="text-slate-300 text-sm font-medium"><?php echo e($game->date?->format('F d, Y')); ?> • <?php echo e($game->time); ?></span>
            </div>
            <div class="text-slate-400 text-sm">
                 <?php echo e($game->discipline); ?> Match
            </div>
        </div>

        <!-- Scoreboard Area -->
        <div class="p-8 md:p-12 relative">
             <div class="absolute inset-0 opacity-10 pointer-events-none" style="background: linear-gradient(to right, <?php echo e($game->home_color ?? '#3B82F6'); ?>, <?php echo e($game->away_color ?? '#EF4444'); ?>);"></div>

             <div class="relative z-10 flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">
                <!-- Home Team -->
                <div class="flex flex-col items-center text-center w-1/3">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-2xl border-4 border-white dark:border-neutral-800 flex items-center justify-center mb-4 transform hover:scale-105 transition-transform"
                         style="background-color: <?php echo e($game->home_color ?? '#3B82F6'); ?>;">
                        <span class="text-4xl">🏠</span> <!-- Placeholder for logo -->
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight"><?php echo e($game->home_team); ?></h2>
                </div>

                <!-- VS / Score -->
                <div class="flex flex-col items-center justify-center">
                    <?php if($game->home_score !== null && $game->away_score !== null): ?>
                        <div class="text-6xl md:text-8xl font-black text-slate-800 dark:text-white tracking-tighter flex items-center gap-4">
                            <span><?php echo e($game->home_score); ?></span>
                            <span class="text-slate-300 text-4xl">:</span>
                            <span><?php echo e($game->away_score); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-neutral-800 flex items-center justify-center text-xl font-bold text-slate-400">
                            VS
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Away Team -->
                <div class="flex flex-col items-center text-center w-1/3">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-2xl border-4 border-white dark:border-neutral-800 flex items-center justify-center mb-4 transform hover:scale-105 transition-transform"
                         style="background-color: <?php echo e($game->away_color ?? '#EF4444'); ?>;">
                        <span class="text-4xl">✈️</span> <!-- Placeholder for logo -->
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight"><?php echo e($game->away_team); ?></h2>
                </div>
             </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Info Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Key Info Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800">
                    <div class="text-indigo-500 mb-1 text-lg">🏆</div>
                    <p class="text-xs text-indigo-400 uppercase font-bold tracking-wider">Category</p>
                    <p class="font-bold text-indigo-900 dark:text-white"><?php echo e($game->category); ?></p>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-xl border border-purple-100 dark:border-purple-800">
                    <div class="text-purple-500 mb-1 text-lg">👥</div>
                    <p class="text-xs text-purple-400 uppercase font-bold tracking-wider">Age Group</p>
                    <p class="font-bold text-purple-900 dark:text-white"><?php echo e(is_array($game->age_group) ? implode(', ', $game->age_group) : $game->age_group); ?></p>
                </div>
                <div class="bg-pink-50 dark:bg-pink-900/20 p-4 rounded-xl border border-pink-100 dark:border-pink-800">
                    <div class="text-pink-500 mb-1 text-lg">🚻</div>
                    <p class="text-xs text-pink-400 uppercase font-bold tracking-wider">Gender</p>
                    <p class="font-bold text-pink-900 dark:text-white"><?php echo e($game->gender); ?></p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
                    <div class="text-blue-500 mb-1 text-lg">🏟️</div>
                    <p class="text-xs text-blue-400 uppercase font-bold tracking-wider">Venue</p>
                    <p class="font-bold text-blue-900 dark:text-white truncate" title="<?php echo e($game->venue); ?>"><?php echo e($game->venue ?? '—'); ?></p>
                </div>
            </div>

            <!-- Detailed Stats/Logistics -->
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-gray-50 dark:bg-neutral-800 px-6 py-4 border-b border-gray-100 dark:border-neutral-700">
                     <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span>📋</span> Logistics & Locations
                     </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-green-100 text-green-600 rounded-lg p-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Location</p>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($game->city); ?>, <?php echo e($game->country); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-orange-100 text-orange-600 rounded-lg p-2">🏢</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Base</p>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($game->base ?? 'Not specified'); ?></p>
                            </div>
                        </div>
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-teal-100 text-teal-600 rounded-lg p-2">🚌</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Transport</p>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($game->transport); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-yellow-100 text-yellow-600 rounded-lg p-2">🕒</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Kickoff</p>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($game->time); ?></p>
                            </div>
                        </div>
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-red-100 text-red-600 rounded-lg p-2">🛫</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Departure</p>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($game->departure_time ?? '—'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-blue-100 text-blue-600 rounded-lg p-2">🏁</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Expected End</p>
                                <p class="text-gray-900 dark:text-white font-medium"><?php echo e($game->expected_finish_time ?? '—'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php if($game->objective): ?>
                    <div class="px-6 py-4 bg-yellow-50 dark:bg-yellow-900/10 border-t border-yellow-100 dark:border-yellow-900/20">
                        <p class="text-xs text-yellow-600 dark:text-yellow-400 uppercase font-bold mb-1">🎯 Objective</p>
                        <p class="text-gray-800 dark:text-gray-200 text-sm italic">"<?php echo e($game->objective); ?>"</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Match Report Section (if exists) -->
             <?php if(($game->isCompleted() || $game->yellow_cards_players) && ($game->yellow_cards_players || $game->red_cards_players || $game->incidence || $game->technical_feedback)): ?>
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-100 to-slate-200 dark:from-neutral-800 dark:to-neutral-700 px-6 py-4 border-b border-gray-200 dark:border-neutral-600 flex justify-between items-center">
                     <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span>📝</span> Post-Match Report
                     </h3>
                </div>
                <div class="p-6">
                    <!-- Cards Grid -->
                    <?php if($game->yellow_cards_players || $game->red_cards_players || $game->yellow_cards_staff || $game->red_cards_staff): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <?php if($game->yellow_cards_players || $game->yellow_cards_staff): ?>
                        <div class="bg-yellow-50 dark:bg-yellow-900/10 rounded-xl p-4 border border-yellow-100 dark:border-yellow-800">
                             <h4 class="font-bold text-yellow-700 dark:text-yellow-400 mb-3 flex items-center gap-2">
                                <span class="w-3 h-4 bg-yellow-400 rounded-sm inline-block shadow-sm"></span> Yellow Cards
                             </h4>
                             <?php if($game->yellow_cards_players): ?>
                                <p class="text-xs font-bold text-yellow-600 uppercase mb-1">Players</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <?php $__currentLoopData = $game->yellow_cards_players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $player = \App\Models\Student::find($playerId); ?>
                                        <?php if($player): ?>
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-yellow-700 dark:text-yellow-300 text-xs rounded shadow-sm border border-yellow-200 dark:border-yellow-800"><?php echo e($player->first_name); ?> <?php echo e($player->second_name); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                             <?php endif; ?>
                              <?php if($game->yellow_cards_staff): ?>
                                <p class="text-xs font-bold text-yellow-600 uppercase mb-1">Staff</p>
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $game->yellow_cards_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $staff = \App\Models\Staff::find($staffId); ?>
                                        <?php if($staff): ?>
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-yellow-700 dark:text-yellow-300 text-xs rounded shadow-sm border border-yellow-200 dark:border-yellow-800"><?php echo e($staff->name); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                             <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php if($game->red_cards_players || $game->red_cards_staff): ?>
                         <div class="bg-red-50 dark:bg-red-900/10 rounded-xl p-4 border border-red-100 dark:border-red-800">
                             <h4 class="font-bold text-red-700 dark:text-red-400 mb-3 flex items-center gap-2">
                                <span class="w-3 h-4 bg-red-500 rounded-sm inline-block shadow-sm"></span> Red Cards
                             </h4>
                             <?php if($game->red_cards_players): ?>
                                <p class="text-xs font-bold text-red-600 uppercase mb-1">Players</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <?php $__currentLoopData = $game->red_cards_players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $player = \App\Models\Student::find($playerId); ?>
                                         <?php if($player): ?>
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-red-700 dark:text-red-300 text-xs rounded shadow-sm border border-red-200 dark:border-red-800"><?php echo e($player->first_name); ?> <?php echo e($player->second_name); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                             <?php endif; ?>
                              <?php if($game->red_cards_staff): ?>
                                <p class="text-xs font-bold text-red-600 uppercase mb-1">Staff</p>
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $game->red_cards_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $staff = \App\Models\Staff::find($staffId); ?>
                                        <?php if($staff): ?>
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-red-700 dark:text-red-300 text-xs rounded shadow-sm border border-red-200 dark:border-red-800"><?php echo e($staff->name); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                             <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <div class="space-y-6">
                        <?php if($game->incidence): ?>
                        <div class="p-4 bg-gray-50 dark:bg-neutral-800 rounded-lg border border-gray-100 dark:border-neutral-700">
                             <h4 class="font-bold text-gray-700 dark:text-gray-200 mb-2">📢 Incidents & Events</h4>
                             <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed"><?php echo e($game->incidence); ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if($game->technical_feedback): ?>
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark:border-blue-800">
                             <h4 class="font-bold text-blue-700 dark:text-blue-200 mb-2">💡 Technical Feedback</h4>
                             <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed"><?php echo e($game->technical_feedback); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Staff Widget -->
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-slate-50 dark:bg-neutral-800 px-4 py-3 border-b border-gray-100 dark:border-neutral-700 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">👔 Coaching Staff
                        <?php if($game->staff_ids && count($game->staff_ids) > 0): ?>
                            <span class="text-[11px] bg-slate-200 dark:bg-neutral-700 text-slate-600 dark:text-slate-300 px-2 py-0.5 rounded-full font-bold"><?php echo e(count($game->staff_ids)); ?></span>
                        <?php endif; ?>
                    </h3>
                    <?php if($game->notify_staff): ?>
                        <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold uppercase tracking-wide">Notified</span>
                    <?php endif; ?>
                </div>
                <div class="p-4">
                    <?php if($game->staff_ids && count($game->staff_ids) > 0): ?>
                        <?php $staffList = \App\Models\Staff::whereIn('id', $game->staff_ids)->get()->keyBy('id'); ?>
                        <ul class="space-y-3">
                            <?php $__currentLoopData = $game->staff_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $staff = $staffList->get($staffId); ?>
                                <?php if($staff): ?>
                                <li class="flex items-center gap-3">
                                    <img src="<?php echo e($staff->photo_url); ?>" alt="<?php echo e($staff->first_name); ?>" class="w-9 h-9 rounded-full object-cover border-2 border-slate-200 dark:border-neutral-700 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate"><?php echo e($staff->first_name); ?> <?php echo e($staff->last_name); ?></p>
                                        <?php if($staff->role_function): ?>
                                            <p class="text-xs text-indigo-500 dark:text-indigo-400 truncate"><?php echo e($staff->role_function); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                    <div class="text-center py-4">
                        <p class="text-sm text-gray-500 italic block">No staff assigned</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Players Widget -->
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-slate-50 dark:bg-neutral-800 px-4 py-3 border-b border-gray-100 dark:border-neutral-700 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">🏃 Squad List
                        <?php if($game->player_ids && count($game->player_ids) > 0): ?>
                            <span class="text-[11px] bg-slate-200 dark:bg-neutral-700 text-slate-600 dark:text-slate-300 px-2 py-0.5 rounded-full font-bold"><?php echo e(count($game->player_ids)); ?></span>
                        <?php endif; ?>
                    </h3>
                </div>
                <div class="p-4">
                    <?php if($game->player_ids && count($game->player_ids) > 0): ?>
                        <?php $playerList = \App\Models\Student::whereIn('id', $game->player_ids)->get()->keyBy('id'); ?>
                        <div class="space-y-1">
                            <?php $__currentLoopData = $game->player_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $player = $playerList->get($playerId); ?>
                                <?php if($player): ?>
                                <div class="flex items-center gap-3 px-2 py-2 hover:bg-slate-50 dark:hover:bg-neutral-800 rounded-lg transition">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center flex-shrink-0">
                                        <?php if($player->jersey_number): ?>
                                            <span class="text-xs font-black text-indigo-700 dark:text-indigo-300">#<?php echo e($player->jersey_number); ?></span>
                                        <?php else: ?>
                                            <span class="text-xs font-bold text-indigo-400"><?php echo e(strtoupper(mb_substr($player->first_name, 0, 1))); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate"><?php echo e($player->first_name); ?> <?php echo e($player->second_name); ?></p>
                                        <?php if($player->position): ?>
                                            <p class="text-xs text-emerald-500 dark:text-emerald-400"><?php echo e($player->position); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                    <div class="text-center py-4">
                        <p class="text-sm text-gray-500 italic">No players assigned</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
             <!-- Actions Widget -->
            <div class="bg-slate-50 dark:bg-neutral-900 p-4 rounded-xl border border-slate-200 dark:border-neutral-800">
                <h3 class="text-xs font-bold text-slate-400 uppercase mb-3">Quick Actions</h3>
                 <div class="grid grid-cols-2 gap-2">
                     <a href="<?php echo e(route('admin.games.edit', $game)); ?>" class="flex flex-col items-center justify-center p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg hover:border-indigo-400 transition group">
                         <span class="text-xl mb-1 group-hover:scale-110 transition-transform">✏️</span>
                         <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Edit</span>
                     </a>
                     <a href="<?php echo e(route('admin.games.report', $game)); ?>" class="flex flex-col items-center justify-center p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg hover:border-indigo-400 transition group">
                         <span class="text-xl mb-1 group-hover:scale-110 transition-transform">📝</span>
                         <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Report</span>
                     </a>
                      <a href="<?php echo e(route('admin.games.index')); ?>" class="flex flex-col items-center justify-center p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg hover:border-indigo-400 transition group col-span-2">
                         <span class="text-xl mb-1 group-hover:scale-110 transition-transform">🔙</span>
                         <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Back to List</span>
                     </a>
                 </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\games\show.blade.php ENDPATH**/ ?>