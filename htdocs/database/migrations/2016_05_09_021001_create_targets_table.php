<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午8:55
 */

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateTargetsTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('targets', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->index();
				$table->string('target_gender');
				$table->integer('ageMin');
				$table->integer('ageMax');
				$table->boolean('isSingle');
				$table->boolean('isNearBy');
				$table->string('relationship');
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
			Schema::drop('targets');
		}
	}
