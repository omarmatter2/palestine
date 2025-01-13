<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>.
 * @Date: 9/10/22, 3:25 PM.
 * @Project: SadeemGeo.
 * @FileName: 2022_09_06_111845_create_geo_countries_table.php.
 ******************************************************************************/


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration {

    /**
     * @var string
     */
    protected string $tableName = 'geo_countries';

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

        if (!Schema::hasColumn($tableName, 'geo_country_id')){$table->unsignedInteger("geo_country_id")->unique()->index();}
        if (!Schema::hasColumn($tableName, 'en_common_name')){$table->string("en_common_name", 50)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'en_official_name')){$table->string("en_official_name", 80)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'ar_common_name')){$table->string("ar_common_name", 50)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'ar_official_name')){$table->string("ar_official_name", 70)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'he_common_name')){$table->string("he_common_name", 50)->nullable()->index();}
        if (!Schema::hasColumn($tableName, 'he_official_name')){$table->string("he_official_name", 70)->nullable()->index();}
        if (!Schema::hasColumn($tableName, 'native_common_name')){$table->string("native_common_name", 50)->nullable();}
        if (!Schema::hasColumn($tableName, 'native_official_name')){$table->string("native_official_name", 80)->nullable();}
        if (!Schema::hasColumn($tableName, 'native_lang_code')){$table->string("native_lang_code", 50)->nullable();}
        if (!Schema::hasColumn($tableName, 'top_level_domine')){$table->string("top_level_domine", 25)->nullable();}
        if (!Schema::hasColumn($tableName, 'code')){$table->char("code", 4)->unique()->index();}
        if (!Schema::hasColumn($tableName, 'code_ccn3')){$table->char("code_ccn3", 4)->nullable();}
        if (!Schema::hasColumn($tableName, 'code_cca3')){$table->char("code_cca3", 4)->nullable();}
        if (!Schema::hasColumn($tableName, 'code_cioc')){$table->char("code_cioc", 4)->nullable();}
        if (!Schema::hasColumn($tableName, 'phone_code')){$table->char("phone_code", 10)->index();}
        if (!Schema::hasColumn($tableName, 'independent')){$table->boolean("independent")->nullable();}
        if (!Schema::hasColumn($tableName, 'currency_code')){$table->string("currency_code", 20)->nullable()->index();}
        if (!Schema::hasColumn($tableName, 'capital_id')){$table->string("capital_id", 50)->nullable()->index();}
        if (!Schema::hasColumn($tableName, 'continent')){$table->string("continent", 30);}
        if (!Schema::hasColumn($tableName, 'latitude')){$table->decimal("latitude", 10, 8)->index();}
        if (!Schema::hasColumn($tableName, 'longitude')){$table->decimal("longitude", 11, 8)->index();}
        if (!Schema::hasColumn($tableName, 'area')){$table->bigInteger("area")->nullable();}
        if (!Schema::hasColumn($tableName, 'flag_image')){$table->string("flag_image");}
        if (!Schema::hasColumn($tableName, 'population')){$table->bigInteger("population")->nullable();}
        if (!Schema::hasColumn($tableName, 'start_of_week')){$table->string("start_of_week", 15)->nullable();}
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
            if (Schema::hasColumn($tableName, 'geo_country_id')) {$table->dropColumn('geo_country_id');}
            if (Schema::hasColumn($tableName, 'en_common_name')) {$table->dropColumn('en_common_name');}
            if (Schema::hasColumn($tableName, 'en_official_name')) {$table->dropColumn('en_official_name');}
            if (Schema::hasColumn($tableName, 'ar_common_name')) {$table->dropColumn('ar_common_name');}
            if (Schema::hasColumn($tableName, 'ar_official_name')) {$table->dropColumn('ar_official_name');}
            if (Schema::hasColumn($tableName, 'he_common_name')) {$table->dropColumn('he_common_name');}
            if (Schema::hasColumn($tableName, 'he_official_name')) {$table->dropColumn('he_official_name');}
            if (Schema::hasColumn($tableName, 'native_common_name')) {$table->dropColumn('native_common_name');}
            if (Schema::hasColumn($tableName, 'native_official_name')) {$table->dropColumn('native_official_name');}
            if (Schema::hasColumn($tableName, 'native_lang_code')) {$table->dropColumn('native_lang_code');}
            if (Schema::hasColumn($tableName, 'top_level_domine')) {$table->dropColumn('top_level_domine');}
            if (Schema::hasColumn($tableName, 'code')) {$table->dropColumn('code');}
            if (Schema::hasColumn($tableName, 'code_ccn3')) {$table->dropColumn('code_ccn3');}
            if (Schema::hasColumn($tableName, 'code_cca3')) {$table->dropColumn('code_cca3');}
            if (Schema::hasColumn($tableName, 'code_cioc')) {$table->dropColumn('code_cioc');}
            if (Schema::hasColumn($tableName, 'phone_code')) {$table->dropColumn('phone_code');}
            if (Schema::hasColumn($tableName, 'independent')) {$table->dropColumn('independent');}
            if (Schema::hasColumn($tableName, 'currency_code')) {$table->dropColumn('currency_code');}
            if (Schema::hasColumn($tableName, 'capital_id')) {$table->dropColumn('capital_id');}
            if (Schema::hasColumn($tableName, 'continent')) {$table->dropColumn('continent');}
            if (Schema::hasColumn($tableName, 'latitude')) {$table->dropColumn('latitude');}
            if (Schema::hasColumn($tableName, 'longitude')) {$table->dropColumn('longitude');}
            if (Schema::hasColumn($tableName, 'area')) {$table->dropColumn('area');}
            if (Schema::hasColumn($tableName, 'flag_image')) {$table->dropColumn('flag_image');}
            if (Schema::hasColumn($tableName, 'population')) {$table->dropColumn('population');}
            if (Schema::hasColumn($tableName, 'start_of_week')) {$table->dropColumn('start_of_week');}
            if (Schema::hasColumn($tableName, 'status')) {$table->dropColumn('status');}
            if (Schema::hasColumn($tableName, 'will_sync')) {$table->dropColumn('will_sync');}
        });
    }
};
