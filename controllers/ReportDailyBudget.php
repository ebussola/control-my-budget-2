<?php namespace Ebussola\ControlMyBudget\Controllers;

use Backend\Classes\Controller;
use Backend\Widgets\ReportContainer;

class ReportDailyBudget extends Controller
{

    public $implement = [];
    
    public $requiredPermissions = [
        'cmb.report.dailybudget' 
    ];

    public function __construct()
    {
        parent::__construct();

        new ReportContainer($this, [
            'context' => 'controlmybudget',
            'canAddAndDelete' => false,
            'defaultWidgets' => [
                'dailyMonthlyBudget' => [
                    'class' => '\Ebussola\ControlMyBudget\Reportwidgets\DailyMonthlyBudget',
                    'sortOrder' => 1,
                    'configuration' => [
                        'title' => 'Your Daily Budget',
                        'ocWidgetWidth' => 3
                    ]
                ]
            ]
        ]);
    }

    public function index()
    {

    }

    public function index_onInitReportContainer()
    {
        return ['#dashReportContainer' => $this->widget->reportContainer->render()];
    }

}
