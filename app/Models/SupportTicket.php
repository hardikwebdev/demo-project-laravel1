<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use HasFactory,SoftDeletes;

    
    protected $table = "support_tickets";

    protected $dates = [ 'deleted_at' ];

    public function subject() {
        return $this->belongsTo(SuportSubject::class, 'subject_id', 'id');
    }
    public function user_detail() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
