<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'status',
        'is_approved',
        'profile_image',
        'bio',
        'approved_at',
        'approved_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'approved_at' => 'datetime',
            'is_approved' => 'boolean',
        ];
    }

    /**
     * Relationships
     */

    // Data Collector Profile (One-to-One)
    public function dataCollectorProfile()
    {
        return $this->hasOne(DataCollectorProfile::class);
    }

    // Verification Documents (One-to-Many)
    public function verificationDocuments()
    {
        return $this->hasMany(VerificationDocument::class);
    }

    // Farm Records created by this user (One-to-Many)
    public function farmRecords()
    {
        return $this->hasMany(FarmRecord::class, 'user_id');
    }

    // Farm Records where this user is the actual farmer (One-to-Many)
    public function farmerRecords()
    {
        return $this->hasMany(FarmRecord::class, 'farmer_id');
    }

    // Livestock owned by this user (One-to-Many)
    public function livestock()
    {
        return $this->hasMany(Livestock::class, 'user_id');
    }

    // Vaccination History (One-to-Many)
    public function vaccinationHistory()
    {
        return $this->hasMany(VaccinationHistory::class, 'user_id');
    }

    // Service Requests (One-to-Many)
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'user_id');
    }

    // Service Requests assigned to this user (for service providers)
    public function assignedServiceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'assigned_to');
    }

    // Alert Preferences (One-to-One)
    public function alertPreferences()
    {
        return $this->hasOne(AlertPreference::class);
    }

    // Users approved by this admin (One-to-Many)
    public function approvedUsers()
    {
        return $this->hasMany(User::class, 'approved_by');
    }

    // Admin who approved this user (Belongs To)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Role Checking Methods
     */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDataCollector()
    {
        return $this->role === 'data_collector';
    }

    public function isIndividual()
    {
        return $this->role === 'individual';
    }

    /**
     * Status Checking Methods
     */

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isSuspended()
    {
        return $this->status === 'suspended';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->is_approved === true;
    }

    /**
     * Combined Status Check for Data Collectors
     */
    public function canAccessSystem()
    {
        if ($this->isAdmin()) {
            return $this->isActive();
        }

        if ($this->isDataCollector()) {
            return $this->isActive() && $this->isApproved();
        }

        if ($this->isIndividual()) {
            return $this->isActive();
        }

        return false;
    }

    /**
     * Get full address
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->country,
        ]);

        return implode(', ', $parts);
    }

    /**
     * Get profile image URL
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }

        // Return default avatar
        return asset('images/default-avatar.png');
    }

    /**
     * Scope Queries
     */

    // Get only admins
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Get only data collectors
    public function scopeDataCollectors($query)
    {
        return $query->where('role', 'data_collector');
    }

    // Get only individuals
    public function scopeIndividuals($query)
    {
        return $query->where('role', 'individual');
    }

    // Get pending data collectors (awaiting approval)
    public function scopePendingDataCollectors($query)
    {
        return $query->where('role', 'data_collector')
                     ->where('is_approved', false)
                     ->where('status', 'active');
    }

    // Get approved data collectors
    public function scopeApprovedDataCollectors($query)
    {
        return $query->where('role', 'data_collector')
                     ->where('is_approved', true)
                     ->where('status', 'active');
    }

    // Get active users
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Get suspended users
    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        // When creating a user, set default values
        static::creating(function ($user) {
            if (!$user->country) {
                $user->country = 'Nigeria';
            }

            if (!$user->status) {
                $user->status = 'active';
            }

            // Data collectors start as unapproved
            if ($user->role === 'data_collector') {
                $user->is_approved = false;
            } else {
                $user->is_approved = true;
            }
        });
    }
}