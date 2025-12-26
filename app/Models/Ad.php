<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'category',
        'target_roles',
        'target_locations',
        'start_date',
        'end_date',
        'status',
        'views',
        'clicks',
        'created_by'
    ];

    protected $casts = [
        'target_roles' => 'array',
        'target_locations' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'views' => 'integer',
        'clicks' => 'integer'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function adViews(): HasMany
    {
        return $this->hasMany(AdView::class);
    }

    /**
     * Check if ad is active and within date range
     */
    public function isActive(): bool
    {
        return $this->status === 'active'
            && now()->between($this->start_date, $this->end_date);
    }

    /**
     * Check if ad should be shown to user
     */
    public function shouldShowToUser(User $user): bool
    {
        if (!$this->isActive()) {
            return false;
        }

        // Check role targeting
        if ($this->target_roles && !in_array($user->role, $this->target_roles)) {
            return false;
        }

        // Check location targeting
        if ($this->target_locations) {
            $userLocation = [
                'state_id' => $user->state_id,
                'lga_id' => $user->lga_id
            ];

            // Simple check - can be enhanced
            $locationMatch = false;
            foreach ($this->target_locations as $location) {
                if (isset($location['state_id']) && $location['state_id'] == $user->state_id) {
                    $locationMatch = true;
                    break;
                }
            }

            if (!$locationMatch) {
                return false;
            }
        }

        return true;
    }
}
