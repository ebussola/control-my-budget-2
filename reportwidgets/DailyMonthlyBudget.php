<?php
/**
 * Created by PhpStorm.
 * User: shina
 * Date: 4/24/16
 * Time: 10:02 AM
 */

namespace Ebussola\ControlMyBudget\Reportwidgets;


use Backend\Classes\ReportWidgetBase;
use Carbon\Carbon;
use Ebussola\ControlMyBudget\Models\MonthlyGoal;
use Ebussola\ControlMyBudget\Models\Purchase;
use ebussola\goalr\Goal;
use ebussola\goalr\Goalr;

class DailyMonthlyBudget extends ReportWidgetBase
{

    /**
     * Defines the properties used by this class.
     * This method should be used as an override in the extended class.
     */
    public function defineProperties()
    {
        return [
            'current_date' => [
                'title' => _('ebussola.controlmybudget::lang.widget.daily-monthly-budget.property.current_date.label'),
                'description' => _('ebussola.controlmybudget::lang.widget.daily-monthly-budget.property.current_date.description'),
                'type' => 'string'
            ],
            'manual_spent' => [
                'title' => _('asdf'),
                'description' => _('fdsa'),
                'type' => 'string'
            ]
        ];
    }

    /**
     * Initialize the widget, called by the constructor and free from its parameters.
     * @return void
     */
//    public function init()
//    {
//    }

    /**
     * Adds widget specific asset files. Use $this->addJs() and $this->addCss()
     * to register new assets to include on the page.
     * @return void
     */
//    protected function loadAssets()
//    {
//    }

    /**
     * Renders the widgets primary contents.
     * @return string HTML markup supplied by this widget.
     */
    public function render()
    {
        $monthlyGoal = MonthlyGoal::query()
            ->currentUser()
            ->currentMonth()
            ->first()
        ;

        if ($monthlyGoal) {
            $this->vars['dailyBudget'] = $this->processDailyBudget([], $this->property('manual_spent'), $monthlyGoal->makeGoal());
        }
        else {
            \Flash::error(_(''));
        }

        return $this->makePartial('index');
    }

    public function getCurrentDateProperty()
    {
        $currentDate = $this->property('current_date');

        if (preg_match('/....-..-../', $currentDate)) {
            return $currentDate;
        }
        else if ($currentDate === null) {
            return Carbon::now()->format('Y-m-d');
        }
        else {
            return Carbon::now()->format('Y-m-') . $currentDate;
        }
    }

    /**
     * @param Event[] $events
     * @param float $manualSpent
     * @param Goal $goal
     *
     * @return float
     */
    protected function processDailyBudget($events=[], $manualSpent, $goal)
    {
        $yesterday = clone new \DateTime($this->getCurrentDateProperty());
        $yesterday->modify('-1 day');
        $tomorrow = clone new \DateTime($this->getCurrentDateProperty());
        $tomorrow->modify('+1 day');

        $forecastAmountToday = Purchase::query()
            ->currentUser()
            ->onlyForecasts()
            ->byDatePeriod($this->getCurrentDateProperty(), $this->getCurrentDateProperty())
            ->sum('amount');

        $spent =
            Purchase::query()
                ->currentUser()
                ->byDatePeriod($goal->date_start->format('Y-m-d'), $yesterday->format('Y-m-d'))
                ->sum('amount')
            +
            Purchase::query()
                ->currentUser()
                ->byDatePeriod($tomorrow->format('Y-m-d'), $goal->date_end->format('Y-m-d'))
                ->sum('amount')
            +
            $forecastAmountToday;

        if ($manualSpent !== null) {
            $spent += $manualSpent;
        }

        $spentToday =
            Purchase::query()
                ->currentUser()
                ->byDatePeriod($this->getCurrentDateProperty(), $this->getCurrentDateProperty())
                ->sum('amount')
            -
            $forecastAmountToday;

        $goalr = new Goalr();
        $dailyBudget = $goalr->getDailyBudget($goal, $spent, $events);

        return [
            'available' => $dailyBudget - $spentToday,
            'spent' => $spentToday,
            'total' => $dailyBudget
        ];
    }

}
