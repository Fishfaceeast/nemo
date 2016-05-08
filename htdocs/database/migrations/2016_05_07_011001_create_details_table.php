<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/8
 * Time: 上午11:19
 */

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateDetailsTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('details', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->index();
				$table->string('orientation');
				$table->string('status');
				$table->string('nationality');
				$table->integer('height');
				$table->integer('weight');
				$table->string('smoking');
				$table->string('drinking');
				$table->string('religion');
				$table->string('education');
				$table->integer('offspring');
				$table->string('pet');
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
			Schema::drop('details');
		}
	}
