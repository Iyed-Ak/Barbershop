<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'date',
        'time',
        'status',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function getAvailableSlots($date, $serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $dayOfWeek = Carbon::parse($date)->dayOfWeek;

        // Pas de travail le lundi (1 = lundi)
        if ($dayOfWeek === 1) {
            return [];
        }

        // Horaires: 9h-12h et 14h-19h
        $slots = [];
        $openingHours = [
            ['start' => '09:00', 'end' => '12:00'],
            ['start' => '14:00', 'end' => '19:00']
        ];

        foreach ($openingHours as $period) {
            $currentTime = Carbon::parse($period['start']);
            $endTime = Carbon::parse($period['end']);

            while ($currentTime->addMinutes($service->duration)->lte($endTime)) {
                $timeSlot = $currentTime->format('H:i');
                
                // Vérifier si le créneau est disponible
                $isBooked = self::where('date', $date)
                    ->where('time', $timeSlot)
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->exists();

                if (!$isBooked) {
                    $slots[] = $timeSlot;
                }
            }
        }

        return $slots;
    }
}