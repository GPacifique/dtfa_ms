<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;

/**
 * App\Models\User
 *
 * @mixin \Spatie\Permission\Traits\HasRoles
 *
 * @method bool hasRole(string|array $roles)
 * @method \Spatie\Permission\Models\Role|array assignRole(...$roles)
 * @method bool hasPermissionTo(string $permission)
 * @method \Spatie\Permission\Models\Permission|array givePermissionTo(...$permissions)
 * @method \Illuminate\Support\Collection getRoleNames()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes, HasPhoto;

    /**
     * Override the photo field name for the HasPhoto trait.
     */
    protected $photoFieldName = 'profile_picture_path';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id',
        'group_id',
        'profile_picture_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getProfilePictureUrlAttribute(): string
    {
        // Generate initials for fallback avatar
        $initials = strtoupper(mb_substr($this->name ?? 'U', 0, 1));

        // Use trait method for consistent photo URL handling
        return $this->getPhotoUrlFromPath($this->profile_picture_path, $initials, '3b82f6');
    }

    /**
     * Alias for profile_picture_url for consistency with other models.
     */
    public function getPhotoUrlAttribute(): string
    {
        return $this->getProfilePictureUrlAttribute();
    }

    /**
     * Send a password reset notification to the user.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
