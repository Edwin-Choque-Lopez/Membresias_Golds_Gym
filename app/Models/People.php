<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    /** @use HasFactory<\Database\Factories\PeopleFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'peoples';
    protected $fillable = [
        'ci',
        'user_id',
        'name',
        'phone',
        'registration_date',
        'gender',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function ClientMemberships(): HasMany
    {
        return $this->hasMany(Client_Membership::class, 'client_id','id');
    }
}
