<?php namespace App\Modules\Auth\Seeds;

use Eloquent, Str, Schema, DB;
use Hash;

class DatabaseSeeder extends \Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		if (Schema::hasTable('users')) {

			DB::table('users')->insert(array(
				array(
					'email'    => 'admin@localhost',
					'username' => 'admin',
					'password' => Hash::make('admin'),
					'created_at' => date("Y-m-d H:i:s")
				),
			));

		}
	}

}
