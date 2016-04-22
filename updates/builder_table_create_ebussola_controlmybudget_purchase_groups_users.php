<?php namespace Ebussola\ControlMyBudget\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEbussolaControlmybudgetPurchaseGroupsUsers extends Migration
{
    public function up()
    {
        Schema::create('ebussola_controlmybudget_purchase_groups_users', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('purchase_group_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('purchase_group_id')
                ->references('id')
                ->on('ebussola_controlmybudget_purchase_groups');

            $table->foreign('user_id')
                ->references('id')
                ->on('backend_users');

            $table->primary(['purchase_group_id','user_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ebussola_controlmybudget_purchase_groups_users');
    }
}