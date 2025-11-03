<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client_Membership extends Model
{
    /** @use HasFactory<\Database\Factories\ClientMembershipFactory> */
    use HasFactory, SoftDeletes;
    protected $table = 'client_memberships';
    protected $fillable = [
        'client_id',
        'membership_status_id',
        'payment_status_id',
        'menbership_id',
        'start_date',
        'end_date',
        'total_price',
        'peding_balance',
        'advance_payment',
        'group_code',
    ];

    public function MembershipStatuse():BelongsTo
    {
        return $this->belongsTo(Membership_Statuse::class,'memebership_status_id','id');
    }
    public function PaymentStatuse():BelongsTo
    {
        return $this->belongsTo(Payment_Statuse::class,'payment_status_id','id');
    }
    public function Membership():BelongsTo
    {
        return $this->belongsTo(Membership::class, 'menbership_id','id');
    }
    public function Client():BelongsTo
    {
        return $this->belongsTo(People::class, 'client_id','id');
    }
    public function Tickets():HasMany
    {
        return $this->hasMany(Ticket::class,'client_membership_id','id');
    }
}
