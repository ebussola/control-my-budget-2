<?php namespace Ebussola\ControlMyBudget\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEbussolaControlmybudgetPurchaseGroups extends Migration
{
    public function up()
    {
        Schema::create('ebussola_controlmybudget_purchase_groups', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);

            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ebussola_controlmybudget_purchase_groups');
    }
}