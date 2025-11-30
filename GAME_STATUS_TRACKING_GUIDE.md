# Game/Match Status Tracking System

## Overview
The games table now implements a complete status tracking system to separate match creation workflows from match reporting workflows. This prevents accidental modification of scheduling details while a match is in progress or completed.

---

## Status Lifecycle

### 1. **SCHEDULED** (Initial State) 📅
- Match is planned but not yet started
- **User Actions Available:**
  - ✏️ Edit all creation fields (teams, date, time, venue, staff, players, etc.)
  - ▶️ Start the match when ready
  - 🗑️ Delete the match if needed

- **Disabled Fields:** Reporting fields (scores, cards, incidents, feedback)

---

### 2. **IN_PROGRESS** (Active State) 🏃
- Match is currently happening
- **User Actions Available:**
  - 📝 Edit the form to record:
    - Match scores
    - Yellow cards (players & staff)
    - Red cards (players & staff)
    - Incidents/events
    - Technical feedback
  - ✏️ Minor edits to creation details still allowed
  - ✅ Complete the match when done

- **Protected Fields:** Most scheduling fields are disabled to prevent accidental changes during live match

---

### 3. **COMPLETED** (Final State) ✅
- Match is finished with full report recorded
- **User Actions Available:**
  - 👁️ View the complete match report
  - ✏️ Edit the form (all fields available for corrections)
  - 🗑️ Delete if needed

- **Status Display:** Shows final scores and match report details

---

## Database Changes

### Migration: `2025_11_30_000000_add_status_to_games_table.php`
```php
Schema::table('games', function (Blueprint $table) {
    $table->enum('status', ['scheduled', 'in_progress', 'completed'])->default('scheduled');
});
```

### Model: Game.php
Added to `$fillable`:
```php
'status', // ← New field
'discipline', 'home_team', ...existing fields...
```

---

## Model Methods

### Status Checking
```php
$game->isScheduled()   // bool - Check if scheduled
$game->isInProgress()  // bool - Check if in progress
$game->isCompleted()   // bool - Check if completed
```

### Status Transitions
```php
$game->startMatch()    // scheduled → in_progress
$game->completeMatch() // in_progress → completed
```

### Query Scopes
```php
Game::scheduled()->get()    // Get all scheduled matches
Game::inProgress()->get()   // Get all in-progress matches
Game::completed()->get()    // Get all completed matches
```

---

## Form Behavior

### Creation Form (_form.blade.php)
The form is **dynamic** based on match status:

#### When Creating (Status: NULL)
- All creation fields **ENABLED**
- All reporting fields **HIDDEN**

#### When Editing Scheduled Match
- All creation fields **ENABLED**
- All reporting fields **HIDDEN**
- Status badge shows current state

#### When Editing In-Progress Match
- Creation fields **DISABLED** (read-only, cannot modify)
- Reporting fields **ENABLED**
- Can record scores, cards, incidents, feedback
- Status badge shows "In Progress" with action prompt

#### When Editing Completed Match
- All fields **ENABLED** (allow corrections)
- Shows final status badge

### Conditional Logic
```blade
@php
    $isScheduled = !$editing || $game->status === 'scheduled';
    $canReport = $editing && ($game->status === 'in_progress' || $game->status === 'completed');
@endphp

<!-- In form -->
<input ... {{ !$isScheduled ? 'disabled' : '' }}>  <!-- Creation fields -->

@if($canReport)
    <!-- Reporting fields section -->
@endif
```

---

## Controller Methods

### GameController.php

#### index()
```php
// Filter matches by status
Game::where('status', request('status'))->paginate(10);
```

#### store()
```php
// New matches always start as 'scheduled'
$data['status'] = 'scheduled';
```

#### startMatch(Game $game)
```php
// POST /admin/games/{game}/start
$game->startMatch(); // scheduled → in_progress
```

#### completeMatch(Game $game)
```php
// POST /admin/games/{game}/complete
$game->completeMatch(); // in_progress → completed
```

---

## Routes

### New Status Transition Routes
```php
Route::post('games/{game}/start', [GameController::class, 'startMatch'])
    ->name('admin.games.start');

Route::post('games/{game}/complete', [GameController::class, 'completeMatch'])
    ->name('admin.games.complete');
```

---

## UI Components

### Index View (admin/games/index.blade.php)
**Features:**
- ✅ Status filter tabs (All / Scheduled / In Progress / Completed)
- ✅ Color-coded status badges
  - 🔵 Blue for Scheduled
  - 🟡 Yellow for In Progress
  - 🟢 Green for Completed
- ✅ Shows scores only for completed matches
- ✅ Responsive table with hover effects

### Show View (admin/games/show.blade.php)
**Features:**
- ✅ Large status badge with context
- ✅ Action buttons based on status:
  - "🏃 Start Match" - Only for scheduled
  - "📝 Record Results" - Only for in_progress
- ✅ Team colors and scores in card layout
- ✅ Match details grid
- ✅ Staff and players list in sidebar
- ✅ Match report section (visible when completed)
- ✅ Yellow/red cards display with names

### Form View (_form.blade.php)
**Features:**
- ✅ Status badge at top of form
- ✅ Two sections:
  - 📋 Match Details (creation fields)
  - 📊 Match Report (reporting fields, conditional)
- ✅ Field validation with error messages
- ✅ Old value persistence for form re-renders
- ✅ Dark mode support throughout

---

## User Workflows

### Workflow 1: Schedule a Match
1. Click "Create New Match" button
2. Fill match creation fields (teams, date, time, venue, staff, players)
3. Click "Create Match" → Status: SCHEDULED ✅

### Workflow 2: Start and Report a Match
1. View match in index
2. Click "Edit" or "View"
3. In show view, click "🏃 Start Match" → Status: IN_PROGRESS
4. Click "📝 Record Results"
5. Fill in scores, cards, incidents, feedback
6. Click "Update Match" → Still IN_PROGRESS (editing allowed)
7. When ready, click "✅ Complete Match" → Status: COMPLETED

### Workflow 3: View Completed Match Report
1. View match in index (shows final score)
2. Click "View"
3. See status badge "✅ Completed"
4. View full match report with:
   - Final scores
   - Yellow/red cards with names
   - Incidents
   - Technical feedback

---

## Field Distribution

### Creation Fields (20 fields)
```
Core Match Info:
  - discipline, home_team, home_color, away_team, away_color
  
Scheduling:
  - date, time, departure_time, expected_finish_time
  
Match Details:
  - category, transport, venue, age_group, country, city, base, gender, objective
  
Logistics:
  - staff_ids, notify_staff, player_ids
```

### Reporting Fields (8 fields)
```
Results:
  - home_score, away_score
  
Discipline:
  - yellow_cards_players, red_cards_players
  - yellow_cards_staff, red_cards_staff
  
Notes:
  - incidence, technical_feedback
```

---

## Benefits of This Approach

✅ **Data Integrity**: Can't accidentally change schedule while match is happening
✅ **Clear Workflow**: Users know exactly what to do at each stage
✅ **Separation of Concerns**: Creation and reporting are distinct operations
✅ **Audit Trail**: Status shows when match progressed through lifecycle
✅ **User Experience**: Disabled fields clearly indicate what can/cannot be edited
✅ **Scalability**: Easy to extend with additional statuses or fields
✅ **No Migration Pain**: Single-table approach, no complex relationships

---

## Future Enhancements

- 📧 Email notifications when status changes
- 🔔 Webhook triggers for external integrations
- 📊 Status transition history/audit log
- 🎯 Status filtering in admin dashboard
- 🔒 Role-based access per status (e.g., only coaches can report)
- 📈 Analytics on match lifecycle times
