<?php namespace Ebussola\ControlMyBudget\Models;

use Model;

/**
 * Model
 */
class PeriodGoal extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|string',
        'date_start' => 'required|date|before:date_end',
        'date_end' => 'required|date|after:date_start',
        'amount_goal' => 'required|numeric'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'amount_goal'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ebussola_controlmybudget_period_goal';

}