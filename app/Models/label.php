<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class label extends Model
{
    use HasFactory;
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'label_ticket', 'label_id', 'ticket_id');
    }
}
