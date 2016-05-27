<?php namespace Ebussola\ControlMyBudget\Models;

use Carbon\Carbon;
use Model;
use October\Rain\Database\Builder;

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
        'place' => 'required|string',
        'amount' => 'required|numeric',
        'is_forecast' => 'boolean',
        'user_id' => 'exists:backend_users,id',
        'purchase_group_id' => 'exists:ebussola_controlmybudget_purchase_groups,id'
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
        'purchase_group' => ['\Ebussola\ControlMyBudget\Models\PurchaseGroup'],
        'user' => ['\Backend\Models\User']
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($self) {
            if ($self->purchase_group == null) {
                $self->user = \BackendAuth::getUser();
            }
            else {
                $self->user = null;
            }

            $self->is_forecast = $self->date->isFuture();
        });
    }

    public function scopeCurrentUser(Builder $query)
    {
        $query->where('user_id', \BackendAuth::getUser()->id);
    }

    public function scopeByDatePeriod(Builder $query, $start, $end)
    {
        $query
            ->where(\DB::raw('date(date)'), '>=', $start)
            ->where(\DB::raw('date(date)'), '<=', $end)
        ;
    }

    public function scopeOnlyForecasts(Builder $query)
    {
        $query->where('is_forecast', true);
    }


}