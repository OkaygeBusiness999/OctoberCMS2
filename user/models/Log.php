<?php namespace AppUser\User\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use Carbon\Carbon;

class Log extends Model
{
    use Validation;

    protected $table = 'appuser_user_logs';

    protected $fillable = ['description', 'user_id', 'arrival_time', 'has_delay', 'log_status'];

    public $rules = [
        'description' => 'required|string',
        'user_id' => 'required|integer',
        'arrival_time' => 'required|date_format:H:i',
    ];

    public $belongsTo = [
        'user' => ['AppUser\User\Models\User', 'key' => 'user_id']
    ];


    public function beforeSave()
    {
        $eightAM = Carbon::createFromTime(8, 0);
        $eightTenAM = Carbon::createFromTime(8, 10);
        $eightPM = Carbon::createFromTime(20, 0);
        $arrivalTime = Carbon::createFromFormat('H:i', $this->arrival_time);
    
        $this->log_status = 'on time';
    
        if ($arrivalTime->between($eightAM, $eightTenAM)) {
            $this->log_status = 'on time with delay';
            $this->has_delay = true;
        } elseif ($arrivalTime->greaterThan($eightTenAM) && $arrivalTime->lessThan($eightPM)) {
            $this->log_status = 'late';
            $this->has_delay = true;
        } elseif ($arrivalTime->greaterThanOrEqualTo($eightPM)) {
            $this->log_status = 'absent';
            $this->has_delay = false;
        } else {
            $this->has_delay = false;
        }
    }

    public function getLogStatusAttribute()
{
    return $this->attributes['log_status'] ?? 'Unknown';
}
}
