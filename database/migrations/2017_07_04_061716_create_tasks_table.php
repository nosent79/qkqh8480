<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('task_id');
            $table->string('title', 255)->comment('태스크 제목');
            $table->enum('task_type', ['product', 'price'])->comment('태스트 구분')->default('product');
            $table->enum('task_state', ['w', 'cw', 'dw', 'dc', 'wc', 'd'])->comment('태스크 상태')->default('w');
            $table->enum('priority', ['a', 'b', 'c', 'd'])->nullable()->comment('중요도');
            $table->unsignedInteger('price')->comment('금액')->default(0);
            $table->date('deposit_date')->comment('입금일자')->default('0000-00-00');
            $table->string('corp_name', 255)->comment('업체명')->default('');
            $table->string('blog_url', 255)->comment('블로그주소')->default('');
            $table->string('comment')->comment('비고')->default('');
            $table->date('deadline_date')->comment('마감기한')->default('0000-00-00');
            $table->timestamp('reg_date')->comment('등록일자')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('reg_id', 30)->comment('등록자아이디')->default('');
            $table->timestamp('upd_date')->comment('수정일자')->default('0000-00-00 00:00:00');
            $table->string('upd_id', 30)->comment('수정자아이디')->default('');
            $table->timestamp('del_date')->comment('삭제일자')->default('0000-00-00 00:00:00');
            $table->string('del_id', 30)->comment('삭제자아이디')->default('');

            $table->index(['deposit_date', 'task_state'], 'idx_deposit_date_and_task_state');
            $table->index(['deadline_date', 'task_state'], 'idx_deadline_date_and_task_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
