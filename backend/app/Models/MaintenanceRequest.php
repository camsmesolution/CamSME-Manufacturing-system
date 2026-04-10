<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use \App\Traits\ScopeByOrganization, \App\Traits\Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'equipment_id',
        'request_type',
        'priority',
        'status',
        'scheduled_date',
        'actual_start',
        'actual_end',
        'duration_hours',
        'description',
        'diagnosis',
        'actions_taken',
        'parts_cost',
        'labor_cost',
        'requested_by',
        'assigned_to',
        'organization_id',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'actual_start' => 'datetime',
        'actual_end' => 'datetime',
        'parts_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'duration_hours' => 'decimal:2',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->name)) {
                $year = now()->year;
                $latest = static::withoutGlobalScope('organization')
                    ->withTrashed()
                    ->whereYear('created_at', $year)
                    ->where('name', 'like', "MR-{$year}-%")
                    ->orderBy('id', 'desc')
                    ->first();

                if ($latest && preg_match('/MR-\d{4}-(\d+)/', $latest->name, $matches)) {
                    $count = intval($matches[1]) + 1;
                } else {
                    $count = 1;
                }

                $model->name = 'MR-' . $year . '-' . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function equipment()
    {
        return $this->belongsTo(\App\Models\Equipment::class);
    }

    public function requester()
    {
        return $this->belongsTo(\App\Models\User::class, 'requested_by');
    }

    public function assignee()
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }
}
