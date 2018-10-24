<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RrhhTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SEED
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('shortened')->nullable();
            $table->timestamps();
        });

        // SEED
        Schema::create('management_entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // SEED
        Schema::create('insurance_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // SEED
        Schema::create('employee_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_type_id')->unsigned()->nullable();
            $table->bigInteger('insurance_company_id')->unsigned()->nullable();
            $table->bigInteger('city_identity_card_id')->unsigned()->nullable();
            $table->bigInteger('city_birth_id')->unsigned()->nullable();
            $table->bigInteger('management_entity_id')->unsigned()->nullable();
            $table->string('identity_card')->nullable(); //
            $table->string('first_name')->nullable(); //
            $table->string('second_name')->nullable(); //
            $table->string('last_name')->nullable(); //
            $table->string('mothers_last_name')->nullable(); //
            $table->string('surname_husband')->nullable(); //
            $table->date('birth_date')->nullable(); //
            $table->string('account_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nua_cua')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable(); //
            $table->foreign('employee_type_id')->references('id')->on('employee_types');
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies');
            $table->foreign('city_identity_card_id')->references('id')->on('cities');
            $table->foreign('city_birth_id')->references('id')->on('cities');
            $table->foreign('management_entity_id')->references('id')->on('management_entities');
            $table->timestamps();
        });
        // SEED
        Schema::create('charges', function (Blueprint $table) { //cargos
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->decimal('base_wage', 8, 2)->nullable();
            $table->string('shortened')->nullable();
            $table->timestamps();
        });

        // SEED
        Schema::create('position_groups', function (Blueprint $table) { //unidades
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('shortened')->nullable();
            $table->timestamps();
        });

        // SEED
        Schema::create('positions', function (Blueprint $table) { //puestos
            $table->bigIncrements('id');
            $table->bigInteger('charge_id')->unsigned()->nullable();
            $table->bigInteger('position_group_id')->unsigned()->nullable();
            $table->string('item')->nullable();
            $table->string('name')->nullable();
            $table->string('shortened')->nullable();
            $table->foreign('charge_id')->references('id')->on('charges');
            $table->foreign('position_group_id')->references('id')->on('position_groups');
            $table->timestamps();
        });
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('position_id')->unsigned();
            $table->date('date_start')->nullable();
            $table->string('date_end')->nullable(); // 2018-10-10 - Libre nombramiento, comisión ...
            $table->string('retirement reason')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->timestamps();
        });

        // SEED
        Schema::create('months', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('shortened');
            $table->timestamps();
        });

        Schema::create('procedures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('month_id')->unsigned();
            $table->integer('year')->nullable();
            $table->string('name')->nullable();
            $table->decimal('discount_old', 8, 2)->default(0);
            $table->decimal('discount_common_risk', 8, 2)->default(0);
            $table->decimal('discount_commission', 8, 2)->default(0);
            $table->decimal('discount_solidary', 8, 2)->default(0);
            $table->decimal('discount_national', 8, 2)->default(0);
            $table->decimal('discount_rc_iva', 8, 2)->default(0);
            $table->decimal('discount_faults', 8, 2)->default(0);
            $table->foreign('month_id')->references('id')->on('months');
            $table->unique(['month_id', 'year']);
            $table->timestamps();
        });

        Schema::create('payrolls', function (Blueprint $table) { //planilla de haberes
            $table->bigIncrements('id');
            $table->bigInteger('contract_id')->unsigned();
            $table->bigInteger('procedure_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('code')->nullable();
            $table->bigInteger('worked_days');
            $table->decimal('base_wage', 8, 2)->nullable();
            $table->decimal('quotable', 8, 2)->nullable();
            $table->decimal('discount_old', 8, 2)->default(0);
            $table->decimal('discount_common_risk', 8, 2)->default(0);
            $table->decimal('discount_commission', 8, 2)->default(0);
            $table->decimal('discount_solidary', 8, 2)->default(0);
            $table->decimal('discount_national', 8, 2)->default(0);
            $table->decimal('total_amount_discount_law', 8, 2)->nullable();
            $table->decimal('net_salary', 8, 2)->nullable();
            $table->decimal('discount_rc_iva', 8, 2)->default(0);
            $table->decimal('discount_faults', 8, 2)->default(0);
            $table->decimal('total_amount_discount_institution', 8, 2)->nullable();
            $table->decimal('total_discounts', 8, 2)->nullable();
            $table->decimal('payable_liquid', 8, 2)->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('procedure_id')->references('id')->on('procedures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
        Schema::dropIfExists('procedures');
        Schema::dropIfExists('months');
        Schema::dropIfExists('contracts');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('position_groups');
        Schema::dropIfExists('charges');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_types');
        Schema::dropIfExists('insurance_companies');
        Schema::dropIfExists('management_entities');
        Schema::dropIfExists('cities');
    }
}
