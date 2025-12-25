<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalHealthProfessional extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'animal_health_professionals';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'professional_type',
        'license_number',
        'organization',
        'experience_years',
        'specialization',
        'assigned_territory',
        'contact_phone',
        'contact_email',
        'approval_status',
        'approved_by',
        'approved_at',
        'rejection_reason',
        'submitted_at',
        'application_notes',
        'verification_documents',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'approved_at' => 'datetime',
        'submitted_at' => 'datetime',
        'experience_years' => 'integer',
        'verification_documents' => 'array',
    ];

    /**
     * Get the user that owns the professional profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved/rejected the application.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get farm records created by this professional.
     */
    public function farmRecords()
    {
        return $this->hasMany(FarmRecord::class, 'professional_id');
    }

    /**
     * Scope to get pending applications.
     */
    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    /**
     * Scope to get approved applications.
     */
    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    /**
     * Scope to get rejected applications.
     */
    public function scopeRejected($query)
    {
        return $query->where('approval_status', 'rejected');
    }

    /**
     * Scope to filter by professional type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('professional_type', $type);
    }

    /**
     * Check if the application is pending.
     */
    public function isPending()
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Check if the application is approved.
     */
    public function isApproved()
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if the application is rejected.
     */
    public function isRejected()
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute()
    {
        return match($this->approval_status) {
            'approved' => 'green',
            'rejected' => 'red',
            'pending' => 'yellow',
            default => 'gray',
        };
    }

    /**
     * Get the professional type display text.
     */
    public function getProfessionalTypeTextAttribute()
    {
        return match($this->professional_type) {
            'veterinarian' => 'Veterinarian',
            'paraveterinarian' => 'Paraveterinarian',
            'community_animal_health_worker' => 'Community Animal Health Worker',
            'others' => 'Other Professional',
            default => ucfirst($this->professional_type),
        };
    }

    /**
     * Get the status display text.
     */
    public function getStatusTextAttribute()
    {
        return ucfirst($this->approval_status);
    }
}