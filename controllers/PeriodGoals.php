<?php namespace Ebussola\ControlMyBudget\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class PeriodGoals extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'cmb.periodgoal' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ebussola.ControlMyBudget', 'cmb', 'periodgoal');
    }
}