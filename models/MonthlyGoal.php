<?php namespace Ebussola\ControlMyBudget\Models;

use Carbon\Carbon;
use ebussola\goalr\goal\Goal;
use Model;
use October\Rain\Database\Builder;

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
        'amount_goal' => 'required|numeric',
        'user_id' => 'exists:backend_users,id'
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
     * protected $belongsTo = [
     *     'parent' => ['Category', 'key' => 'parent_id']
     * ];
     */
    public $belongsTo = [
        'user' => ['\Backend\Models\User']
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ebussola_controlmybudget_monthly_goal';

    protected static function boot()
    {
        parent::boot();

        self::creating(function($self) {
            $self->user = \BackendAuth::getUser();
        });
    }

    public function getYearMonthAttribute()
    {
        return $this->year. '-' .$this->month;
    }

    public function scopeCurrentUser(Builder $query)
    {
        $query->where('user_id', \BackendAuth::getUser()->id);
    }

    public function scopeCurrentMonth(Builder $query)
    {
        $query->where('month', Carbon::now()->format('m'))
            ->where('year', Carbon::now()->format('Y'));
    }

    /**
     * Generate a Goal based on MonthlyGoal values
     *
     * @return Goal
     */
    public function makeGoal()
    {
        $goal = new Goal();
        $goal->date_start = new \DateTime(
            Carbon::create($this->year, $this->month)
                ->startOfMonth()
                ->toFormattedDateString()
        );
        $goal->date_end = new \DateTime(
            Carbon::create($this->year, $this->month)
                ->endOfMonth()
                ->toFormattedDateString()
        );
        $goal->total_budget = $this->amount_goal;

        return $goal;
    }

}