# Game Table Separation Analysis

## Current Game Table Structure
The `games` table currently contains **31 fields** that serve two distinct purposes:
1. **Match Creation/Planning** - Fields needed to schedule and organize a match
2. **Match Reporting** - Fields needed to record match results and incidents

---

## Field Categorization

### 1️⃣ MATCH CREATION FIELDS (Schedule & Planning)
These fields are required when **creating/scheduling** a new match.

| Field | Type | Purpose | Required |
|-------|------|---------|----------|
| `discipline` | enum | Sport type (Football/Basketball) | ✅ Yes |
| `home_team` | string | Home team name | ✅ Yes |
| `home_color` | string | Home team jersey color | ❌ Optional |
| `away_team` | string | Away team name | ✅ Yes |
| `away_color` | string | Away team jersey color | ❌ Optional |
| `objective` | text | Match objective/goals | ❌ Optional |
| `date` | date | Match date | ✅ Yes |
| `time` | time | Match start time | ✅ Yes |
| `departure_time` | time | When staff/team departs | ❌ Optional |
| `expected_finish_time` | time | Expected match end time | ❌ Optional |
| `category` | enum | Match type (In house/Friendly/League) | ✅ Yes |
| `transport` | enum | Transport mode (Self/Group) | ✅ Yes |
| `venue` | string | Match venue | ❌ Optional |
| `age_group` | enum | Age category (u18/u16/u14/u12) | ✅ Yes |
| `country` | enum | Country (Rwanda/Tanzania) | ✅ Yes |
| `city` | string | City location | ❌ Optional |
| `base` | string | Base/facility | ❌ Optional |
| `gender` | enum | Gender category (Male/Female/Mixed) | ✅ Yes |
| `staff_ids` | json | Staff assigned to match | ❌ Optional |
| `notify_staff` | boolean | Send notifications to staff | ❌ Optional |
| `player_ids` | json | Players to participate | ❌ Optional |

**Total Creation Fields: 20**

---

### 2️⃣ MATCH REPORTING FIELDS (Results & Incidents)
These fields are populated when **reporting** match results and incidents.

| Field | Type | Purpose | Notes |
|-------|------|---------|-------|
| `home_score` | integer | Home team final score | Match completed |
| `away_score` | integer | Away team final score | Match completed |
| `yellow_cards_players` | json | Player yellow card records | Incident tracking |
| `red_cards_players` | json | Player red card records | Incident tracking |
| `yellow_cards_staff` | json | Staff yellow card records | Incident tracking |
| `red_cards_staff` | json | Staff red card records | Incident tracking |
| `incidence` | text | Notable incidents/events | Post-match report |
| `technical_feedback` | text | Technical observations | Performance review |

**Total Reporting Fields: 8**

---

### 3️⃣ SYSTEM FIELDS (Both)
| Field | Type | Purpose |
|-------|------|---------|
| `id` | integer | Primary key |
| `created_at` | timestamp | Record creation time |
| `updated_at` | timestamp | Record update time |

---

## Proposed Two-Table Structure

### Option A: Single Table with Status Field (Recommended)
**Keep single `games` table** but track status progression:
- Add `status` column: `scheduled` → `in_progress` → `completed`
- Use conditional visibility in forms based on status
- Simpler data relationships and no complex migrations

```php
// In migration
$table->enum('status', ['scheduled', 'in_progress', 'completed'])->default('scheduled');
```

**Advantages:**
- ✅ No complex foreign keys needed
- ✅ Easy audit trail of creation → reporting
- ✅ Single source of truth
- ✅ Simpler queries and relationships

---

### Option B: Separate Tables (More Normalized)
**Split into `games` (creation) and `match_reports` (reporting):**

#### **games** Table (Match Planning)
```php
Schema::create('games', function (Blueprint $table) {
    $table->id();
    $table->enum('discipline', ['Football', 'Basketball']);
    $table->string('home_team');
    $table->string('home_color')->nullable();
    $table->string('away_team');
    $table->string('away_color')->nullable();
    $table->text('objective')->nullable();
    $table->date('date');
    $table->time('time');
    $table->time('departure_time')->nullable();
    $table->time('expected_finish_time')->nullable();
    $table->enum('category', ['In house', 'Friendly', 'League']);
    $table->enum('transport', ['Self', 'Group']);
    $table->string('venue')->nullable();
    $table->enum('age_group',['u18', 'u16', 'u14', 'u12']);
    $table->enum('country', ['Rwanda', 'Tanzania']);
    $table->string('city')->nullable();
    $table->string('base')->nullable();
    $table->enum('gender', ['Male', 'Female', 'Mixed']);
    $table->json('staff_ids')->nullable();
    $table->boolean('notify_staff')->default(false);
    $table->json('player_ids')->nullable();
    $table->timestamps();
});
```

#### **match_reports** Table (Match Results)
```php
Schema::create('match_reports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
    $table->integer('home_score')->nullable();
    $table->integer('away_score')->nullable();
    $table->json('yellow_cards_players')->nullable();
    $table->json('red_cards_players')->nullable();
    $table->json('yellow_cards_staff')->nullable();
    $table->json('red_cards_staff')->nullable();
    $table->text('incidence')->nullable();
    $table->text('technical_feedback')->nullable();
    $table->timestamps();
});
```

**Advantages:**
- ✅ Clean separation of concerns
- ✅ Better data organization
- ✅ Easier to query reporting data separately
- ✅ Scalable for analytics/reporting

**Disadvantages:**
- ❌ Requires migration work
- ❌ Needs foreign key relationships
- ❌ More complex queries for full match view

---

## Recommendation

### **Use Option A (Add Status Column)**
- **Why?** Current single table structure works well
- **Less disruptive** than creating new tables
- **Easier to implement** - one migration only
- **Maintains existing relationships** with other models
- **Status-based visibility** in UI is simple and clean

### Implementation Steps:
1. Create migration adding `status` column to `games`
2. Update `Game` model with `status` in `$fillable`
3. Create conditional form views:
   - **Create Game Form** - shows creation fields, hides reporting fields
   - **Report Match Form** - shows reporting fields, requires completed game
4. Add model scopes for querying by status
5. Update controllers to handle status transitions

---

## Field Distribution Summary

```
┌─────────────────────────────────────┐
│         GAMES TABLE (Current)       │
├─────────────────────────────────────┤
│  Creation Fields:         20 fields │
│  Reporting Fields:         8 fields │
│  System Fields:            3 fields │
│  ─────────────────────────────────  │
│  TOTAL:                   31 fields │
└─────────────────────────────────────┘
```

---

## Next Steps
Confirm preferred approach (Option A or B) to proceed with:
- Migration file creation
- Model updates
- Form refactoring
- Controller logic updates
