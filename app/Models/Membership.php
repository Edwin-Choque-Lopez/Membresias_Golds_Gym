<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipFactory> */
    use HasFactory, SoftDeletes;
    protected $table = 'memberships';
    protected $fillable = [
        'name',
        'duration_months',
        'price',
        'is_group',
        'description',
    ];

    public function ClientMemberships(): HasMany
    {
        return $this->hasMany(Client_Membership::class,'membership_id','id');
    }
}
