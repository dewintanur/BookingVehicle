<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'approver_id',
        'status',
    ];

    // Relasi ke model Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relasi ke model User (approver)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    // Relasi ke model User (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
