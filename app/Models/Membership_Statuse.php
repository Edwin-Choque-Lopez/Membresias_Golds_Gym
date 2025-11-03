<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership_Statuse extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipSatuFactory> */
    use HasFactory,SoftDeletes;
    protected $table = 'membership_statuses';
    protected $fillable = [
        'name',
    ];

    public function ClientsMemberships(): HasMany
    {
        return $this->hasMany(Client_Membership::class,'membership_status_id','id');
    }
}
