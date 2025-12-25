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
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role',
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
        ];
    }

    /**
     * =========================================
     * RELATIONSHIPS
     * =========================================
     */
    
    public function animalHealthProfessional()
    {
        return $this->hasOne(AnimalHealthProfessional::class);
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    public function livestock()
    {
        return $this->hasMany(Livestock::class, 'owner_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function farmerEnrollments()
    {
        return $this->hasMany(FarmerEnrollment::class, 'farmer_id');
    }

    public function enrolledBy()
    {
        return $this->hasMany(FarmerEnrollment::class, 'enrolled_by');
    }

    /**
     * =========================================
     * ROLE HELPER METHODS
     * =========================================
     */

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is farmer
     */
    public function isFarmer()
    {
        return $this->role === 'farmer';
    }

    /**
     * Check if user is animal health professional
     */
    public function isProfessional()
    {
        return $this->role === 'animal_health_professional';
    }

    /**
     * Check if user is volunteer
     */
    public function isVolunteer()
    {
        return $this->role === 'volunteer';
    }

    /**
     * Check if professional profile is approved
     */
    public function hasApprovedProfessionalProfile()
    {
        if (!$this->isProfessional()) {
            return false;
        }

        $professional = $this->animalHealthProfessional;
        
        return $professional && $professional->approval_status === 'approved';
    }

    /**
     * Get the dashboard route for this user
     */
    public function getDashboardRoute()
    {
        switch ($this->role) {
            case 'admin':
                return 'admin.dashboard';
            case 'farmer':
                return 'farmer.dashboard';
            case 'animal_health_professional':
                return $this->hasApprovedProfessionalProfile() 
                    ? 'professional.dashboard' 
                    : 'professional.pending';
            case 'volunteer':
                return 'volunteer.dashboard';
            default:
                return 'home';
        }
    }
}