<?php namespace Ebussola\ControlMyBudget\Models;

use Model;

/**
 * Model
 */
class PurchaseGroup extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|string'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ebussola_controlmybudget_purchase_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public $hasMany = [
        'purchases' => ['\Ebussola\ControlMyBudget\Models\Purchase']
    ];

    /**
     * protected $belongsToMany = [
     *     'groups' => ['Group', 'table'=> 'join_groups_users']
     * ];
     */
    public $belongsToMany = [
        'users' => ['\Backend\Models\User', 'table' => 'ebussola_controlmybudget_purchase_groups_users']
    ];


}