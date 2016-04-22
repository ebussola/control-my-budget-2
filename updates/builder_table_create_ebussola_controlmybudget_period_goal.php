<?php namespace Ebussola\ControlMyBudget\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEbussolaControlmybudgetPeriodGoal extends Migration
{
    public function up()
    {
        Schema::create('ebussola_controlmybudget_period_goal', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->date('date_start');
            $table->date('date_end');
            $table->decimal('amount_goal', 10, 0);

            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ebussola_controlmybudget_period_goal');
    }
}