<?php namespace Ebussola\ControlMyBudget\Models;

use Model;

/**
 * Model
 */
class MonthlyGoal extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
        'month' => 'required|numeric',
        'year' => 'required|numeric',
        'amount_goal' => 'required|numeric'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month',
        'year',
        'amount_goal'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ebussola_controlmybudget_monthly_goal';

    public function getYearMonthAttribute()
    {
        return $this->year. '-' .$this->month;
    }

}