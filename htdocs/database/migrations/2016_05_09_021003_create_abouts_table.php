<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午9:17
 */

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateAboutsTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('abouts', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->index();
				$table->text('summary');
				$table->string('routine');
				$table->string('skills');
				$table->string('favorite');
				$table->string('necessities');
				$table->string('concerns');
				$table->string('friday');
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
			Schema::drop('abouts');
		}
	}
