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
        'date' => 'required|date',
        'place' => 'required',
        'amount' => 'required|numeric',
        'is_forecast' => 'boolean'
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

    /**
     * protected $belongsTo = [
     *     'parent' => ['Category', 'key' => 'parent_id']
     * ];
     */
    public $belongsTo = [
        'purchase_group' => ['\Ebussola\ControlMyBudget\Models\PurchaseGroup']
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($self) {
            $self->is_forecast = $self->date->isFuture();
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