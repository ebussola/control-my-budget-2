<?php namespace Ebussola\ControlMyBudget\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class Migration107 extends Migration
{
    public function up()
    {
        Schema::table('ebussola_controlmybudget_purchases', function(Blueprint $table)
        {
            $table->foreign('purchase_group_id')
                ->references('id')
                ->on('ebussola_controlmybudget_purchase_groups');
        });
    }

    public function down()
    {
        Schema::table('ebussola_controlmybudget_table', function(Blueprint $table) {
            $table->dropForeign('purchase_group_id');
        });
    }
}