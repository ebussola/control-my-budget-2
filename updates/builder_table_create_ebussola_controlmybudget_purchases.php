<?php namespace Ebussola\ControlMyBudget\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEbussolaControlmybudgetPurchases extends Migration
{
    public function up()
    {
        Schema::create('ebussola_controlmybudget_purchases', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->timestamps();
            $table->increments('id')->unsigned();
            $table->dateTime('date');
            $table->string('place', 255);
            $table->decimal('amount', 10, 0);
            $table->boolean('is_forecast');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('purchase_group_id')->nullable()->unsigned();

            $table->unique(['date', 'place', 'amount', 'user_id', 'purchase_group_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ebussola_controlmybudget_purchases');
    }
}