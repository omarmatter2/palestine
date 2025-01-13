<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>.
 * @Date: 9/10/22, 3:25 PM.
 * @Project: SadeemGeo.
 * @FileName: 2022_09_06_122144_create_geo_districts_table.php.
 ******************************************************************************/


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * @var string
     */
    protected string $tableName = 'geo_districts';

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

        if (!Schema::hasColumn($tableName, 'geo_district_id')){$table->unsignedInteger("geo_district_id")->unique()->index();}
        if (!Schema::hasColumn($tableName, 'en_name')){$table->string("en_name", 50)->index();}
        if (!Schema::hasColumn($tableName, 'ar_name')){$table->string("ar_name", 50)->index();}
        if (!Schema::hasColumn($tableName, 'he_name')){$table->string("he_name", 50)->nullable()->index();}
        if (!Schema::hasColumn($tableName, 'code')){$table->char("code", 8)->nullable()->index();}
        if (!Schema::hasColumn($tableName, 'city_id')){$table->unsignedInteger("city_id")->index();}
        if (!Schema::hasColumn($tableName, 'governorate_id')){$table->unsignedInteger("governorate_id")->index();}
        if (!Schema::hasColumn($tableName, 'country_id')){$table->unsignedInteger("country_id")->index();}
        if (!Schema::hasColumn($tableName, 'continent')){$table->string("continent", 30)->index();}
        if (!Schema::hasColumn($tableName, 'latitude')){$table->decimal("latitude", 10, 8)->nullable();}
        if (!Schema::hasColumn($tableName, 'longitude')){$table->decimal("longitude", 11, 8)->nullable();}
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
            if (Schema::hasColumn($tableName, 'geo_district_id')) {$table->dropColumn('geo_district_id');}
            if (Schema::hasColumn($tableName, 'en_name')) {$table->dropColumn('en_name');}
            if (Schema::hasColumn($tableName, 'ar_name')) {$table->dropColumn('ar_name');}
            if (Schema::hasColumn($tableName, 'he_name')) {$table->dropColumn('he_name');}
            if (Schema::hasColumn($tableName, 'code')) {$table->dropColumn('code');}
            if (Schema::hasColumn($tableName, 'city_id')) {$table->dropColumn('city_id');}
            if (Schema::hasColumn($tableName, 'governorate_id')) {$table->dropColumn('governorate_id');}
            if (Schema::hasColumn($tableName, 'country_id')) {$table->dropColumn('country_id');}
            if (Schema::hasColumn($tableName, 'continent')) {$table->dropColumn('continent');}
            if (Schema::hasColumn($tableName, 'latitude')) {$table->dropColumn('latitude');}
            if (Schema::hasColumn($tableName, 'longitude')) {$table->dropColumn('longitude');}
            if (Schema::hasColumn($tableName, 'status')) {$table->dropColumn('status');}
            if (Schema::hasColumn($tableName, 'will_sync')) {$table->dropColumn('will_sync');}
        });
    }
};
