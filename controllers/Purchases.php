<?php namespace Ebussola\ControlMyBudget\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Carbon\Carbon;
use Ebussola\ControlMyBudget\Models\Purchase;

class Purchases extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'cmb.purchase' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ebussola.ControlMyBudget', 'cmb', 'cmb-purchases');
    }

    /**
     * Creates a new instance of a form model. This logic can be changed
     * by overriding it in the controller.
     * @return Model
     */
    public function formCreateModelObject()
    {
        /** @var Purchase $model */
        $model = parent::formCreateModelObject();
        $model->date = Carbon::now();

        return $model;
    }

    /**
     * Controller override: Extend the query used for populating the list
     * after the default query is processed.
     * @param \October\Rain\Database\Builder $query
     */
    public function listExtendQuery($query, $definition = null)
    {
        $query->currentUser();
    }

}