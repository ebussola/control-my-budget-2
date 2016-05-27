<?php namespace Ebussola\ControlMyBudget\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEbussolaControlmybudgetMonthlyGoal extends Migration
{
    public function up()
    {
        Schema::create('ebussola_controlmybudget_monthly_goal', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('month');
            $table->integer('year');
            $table->decimal('amount_goal', 10, 0);
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('backend_users');

            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ebussola_controlmybudget_monthly_goal');
    }
}