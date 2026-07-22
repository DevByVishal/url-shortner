<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $fillable = [
        'uuid',
        'company_id',
        'invited_by',
        'name',
        'email',
        'role_id',
        'token',
        'accepted_at',
        'expires_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Company
    |--------------------------------------------------------------------------
    */

    public function company(): BelongsTo
    {
        return $this->belongsTo(
            Company::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Invited By
    |--------------------------------------------------------------------------
    */

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'invited_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Role
    |--------------------------------------------------------------------------
    */

    public function role(): BelongsTo
    {
        return $this->belongsTo(
            \Spatie\Permission\Models\Role::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Check Expired
    |--------------------------------------------------------------------------
    */

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /*
    |--------------------------------------------------------------------------
    | Check Accepted
    |--------------------------------------------------------------------------
    */

    public function isAccepted(): bool
    {
        return ! is_null(
            $this->accepted_at
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Check Valid
    |--------------------------------------------------------------------------
    */

    public function isValid(): bool
    {
        return ! $this->isExpired()
            && ! $this->isAccepted();
    }
}