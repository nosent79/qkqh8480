<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->increments('seq');
            $table->string('memo')->comment('메모')->nullable()->default('');
            $table->timestamp('reg_date')->comment('등록일자')->nullable()->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('reg_id', 30)->comment('등록자 아이디')->nullable()->default('');
            $table->string('reg_nm', 30)->comment('등록자 이름')->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memos');
    }
}
