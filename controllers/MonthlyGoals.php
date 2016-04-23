<?php namespace Ebussola\ControlMyBudget\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use October\Rain\Database\Builder;

class MonthlyGoals extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'cmb.monthlygoal' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ebussola.ControlMyBudget', 'cmb', 'monthlygoal');
    }

    /**
     * Controller override: Extend the query used for populating the list
     * after the default query is processed.
     * @param Builder $query
     */
    public function listExtendQuery(Builder $query, $definition = null)
    {
        $isOrderByYearMonth = array_reduce($query->getQuery()->orders, function($result, $order) {
            return $result || $order['column'] === 'year_month';
        }, false);

        $orderByYearMonthDirection = array_reduce($query->getQuery()->orders, function($result, $order) {
            return ($order['column'] === 'year_month') ? $order['direction'] : $result;
        }, 'asc');

        if ($isOrderByYearMonth) {
            $query->getQuery()
                ->orderBy('year', $orderByYearMonthDirection)
                ->orderBy('month', $orderByYearMonthDirection)
            ;
        }
    }

}