<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * =========================================
     * SYSTEM ACCESS METHODS
     * =========================================
     */

    /**
     * Check if user can access the system.
     * This method is required by some middleware or controllers.
     */
    public function canAccessSystem()
    {
        // Admin always has access
        if ($this->isAdmin()) {
            return true;
        }

        // Farmers always have access
        if ($this->isFarmer()) {
            return true;
        }

        // Volunteers always have access (auto-approved)
        if ($this->isVolunteer()) {
            return $this->volunteer && $this->volunteer->is_active;
        }

        // Animal health professionals need approval
        if ($this->isAnimalHealthProfessional()) {
            return $this->hasApprovedProfessionalProfile();
        }

        return false;
    }

    /**
     * =========================================
     * ROLE CHECK METHODS
     * =========================================
     */

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a farmer.
     */
    public function isFarmer()
    {
        return $this->role === 'farmer';
    }

    /**
     * Check if user is an animal health professional.
     */
    public function isAnimalHealthProfessional()
    {
        return $this->role === 'animal_health_professional';
    }

    /**
     * Check if user is a volunteer.
     */
    public function isVolunteer()
    {
        return $this->role === 'volunteer';
    }

    /**
     * Check if user is a data collector (legacy - maps to animal health professional).
     */
    public function isDataCollector()
    {
        return $this->isAnimalHealthProfessional();
    }

    /**
     * Check if user is an individual (legacy - maps to farmer).
     */
    public function isIndividual()
    {
        return $this->isFarmer();
    }

    /**
     * =========================================
     * RELATIONSHIPS - PROFILES
     * =========================================
     */

    /**
     * Get the animal health professional profile for the user.
     */
    public function animalHealthProfessional()
    {
        return $this->hasOne(AnimalHealthProfessional::class);
    }

    /**
     * Get the volunteer profile for the user.
     */
    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    /**
     * Get the data collector profile (legacy - maps to animal health professional).
     */
    public function dataCollectorProfile()
    {
        return $this->animalHealthProfessional();
    }

    /**
     * Get the enrollment record if this user is a farmer.
     */
    public function enrollmentRecord()
    {
        return $this->hasOne(FarmerEnrollment::class, 'farmer_id');
    }

    /**
     * =========================================
     * RELATIONSHIPS - LIVESTOCK & FARM DATA
     * =========================================
     */

    /**
     * Get livestock owned by the user (farmers).
     */
    public function livestock()
    {
        return $this->hasMany(Livestock::class, 'owner_id');
    }

    /**
     * Get farm records created by the user.
     */
    public function farmRecords()
    {
        return $this->hasMany(FarmRecord::class, 'user_id');
    }

    /**
     * Get farm records where user is the farmer.
     */
    public function farmerRecords()
    {
        return $this->hasMany(FarmRecord::class, 'farmer_id');
    }

    /**
     * Get service requests created by the user.
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    /**
     * Get vaccination history for the user.
     */
    public function vaccinationHistory()
    {
        return $this->hasMany(VaccinationHistory::class);
    }

    /**
     * =========================================
     * RELATIONSHIPS - VOLUNTEER ACTIVITIES
     * =========================================
     */

    /**
     * Get farmers enrolled by this user (if volunteer/professional).
     */
    public function enrolledFarmers()
    {
        return $this->hasMany(FarmerEnrollment::class, 'enrolled_by');
    }

    /**
     * =========================================
     * HELPER METHODS
     * =========================================
     */

    /**
     * Get the user's role display name.
     */
    public function getRoleDisplayNameAttribute()
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'farmer' => 'Farmer',
            'animal_health_professional' => 'Animal Health Professional',
            'volunteer' => 'Volunteer',
            default => ucfirst($this->role),
        };
    }

    /**
     * Get the user's dashboard route based on role.
     */
    public function getDashboardRouteAttribute()
    {
        return match($this->role) {
            'admin' => 'admin.dashboard',
            'farmer' => 'individual.dashboard',
            'animal_health_professional' => 'professional.dashboard',
            'volunteer' => 'volunteer.dashboard',
            default => 'dashboard',
        };
    }

    /**
     * Check if user has an approved professional profile.
     */
    public function hasApprovedProfessionalProfile()
    {
        if (!$this->isAnimalHealthProfessional()) {
            return false;
        }

        return $this->animalHealthProfessional()
            ->where('approval_status', 'approved')
            ->exists();
    }

    /**
     * Check if user has an approved volunteer profile.
     */
    public function hasApprovedVolunteerProfile()
    {
        if (!$this->isVolunteer()) {
            return false;
        }

        return $this->volunteer()
            ->where('approval_status', 'approved')
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Get count of farmers enrolled by this user.
     */
    public function getFarmersEnrolledCountAttribute()
    {
        return $this->enrolledFarmers()->count();
    }
}