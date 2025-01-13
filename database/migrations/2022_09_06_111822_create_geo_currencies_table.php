<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>.
 * @Date: 9/10/22, 3:25 PM.
 * @Project: SadeemGeo.
 * @FileName: 2022_09_06_111822_create_geo_currencies_table.php.
 ******************************************************************************/


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * @var string
     */
    protected string $tableName = 'geo_currencies';

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $tableName = $this->tableName;

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->id();
                $this->morph($table);
                $table->timestamps();

                $table->index('created_at');
                $table->index('updated_at');
            });
        }
    }


    /**
     * @param Blueprint $table
     *
     * @return void
     */
    public function morph(Blueprint $table): void
    {
        $tableName = $this->getTableName();

        if (!Schema::hasColumn($tableName, 'geo_currency_id')){$table->unsignedInteger("geo_currency_id")->unique()->index();}
        if (!Schema::hasColumn($tableName, 'en_name')){$table->string("en_name", 40)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'ar_name')){$table->string("ar_name", 40)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'code')){$table->char("code", 8)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'symbol')){$table->char("symbol", 8)->index();}
        if (!Schema::hasColumn($tableName, 'symbol_native')){$table->char("symbol_native", 8)->index();}
        if (!Schema::hasColumn($tableName, 'decimal_digits')){$table->unsignedTinyInteger("decimal_digits")->nullable()->default(0);}
        if (!Schema::hasColumn($tableName, 'name_plural')){$table->string("name_plural", 40)->nullable();}
        if (!Schema::hasColumn($tableName, 'status')){$table->tinyInteger("status")->default(1)->index();}
        if (!Schema::hasColumn($tableName, 'will_sync')){$table->tinyInteger("will_sync")->default(1)->index();}
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $tableName = $this->getTableName();

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if (Schema::hasColumn($tableName, 'geo_currency_id')) {$table->dropColumn('geo_currency_id');}
            if (Schema::hasColumn($tableName, 'en_name')) {$table->dropColumn('en_name');}
            if (Schema::hasColumn($tableName, 'ar_name')) {$table->dropColumn('ar_name');}
            if (Schema::hasColumn($tableName, 'code')) {$table->dropColumn('code');}
            if (Schema::hasColumn($tableName, 'symbol')) {$table->dropColumn('symbol');}
            if (Schema::hasColumn($tableName, 'symbol_native')) {$table->dropColumn('symbol_native');}
            if (Schema::hasColumn($tableName, 'decimal_digits')) {$table->dropColumn('decimal_digits');}
            if (Schema::hasColumn($tableName, 'name_plural')) {$table->dropColumn('name_plural');}
            if (Schema::hasColumn($tableName, 'status')) {$table->dropColumn('status');}
            if (Schema::hasColumn($tableName, 'will_sync')) {$table->dropColumn('will_sync');}
        });
    }
};
