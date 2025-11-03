<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory,SoftDeletes;
    protected $table = 'tickets';
    protected $fillable = [
        'client_membership_id',
        'ticket_datetime',
    ];
    protected $casts = [
        'ticket_datetime' => 'datetime',
    ];
     public function clientMembership():BelongsTo
     {
        return $this->belongsTo(Client_Membership::class,'client_membership_id','id');
     }
}
