<?php namespace Ebussola\ControlMyBudget\Models;

use Carbon\Carbon;
use Model;

/**
 * Model
 */
class Purchase extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ebussola_controlmybudget_purchases';

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var array List of datetime attributes to convert to an instance of Carbon/DateTime objects.
     */
    protected $dates = ['date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'place',
        'amount',
        'is_forecast'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($self) {
            if ($self->date->isFuture()) {
                $self->is_future = true;
            }
        });
    }

    public function scopeByPeriod($query, $start, $end, $userId = null)
    {
        $userId = $userId === null ? \BackendAuth::getUser()->id : $userId;

        $query
            ->where('date', '>=', $start)
            ->where('date', '<=', $end)
            ->where('user_id', $userId)
        ;
    }


}