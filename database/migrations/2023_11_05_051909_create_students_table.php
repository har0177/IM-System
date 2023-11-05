<?php
		
		use App\Models\Course;
		use Illuminate\Database\Migrations\Migration;
		use Illuminate\Database\Schema\Blueprint;
		use Illuminate\Support\Facades\Hash;
		use Illuminate\Support\Facades\Schema;
		return new class extends Migration {
				
				/**
					* Run the migrations.
					* @return void
					*/
				public function up()
				{
						Schema::create( 'students', function( Blueprint $table ) {
								$table->id();
								$table->string( 'reg_no' )->unique();
								$table->string( 'name' );
								$table->string( 'father_name' )->nullable();
								$table->string( 'cnic' )->nullable();
								$table->string( 'address' )->nullable();
								$table->string( 'contact' )->nullable();
								$table->date( 'dob' )->nullable();
								$table->foreignIdFor( Course::class, 'course_id' );
								$table->string( 'qualification' )->nullable();
								$table->string( 'std_of' )->nullable();
								$table->boolean( 'employment' )->default( 0 );
								$table->boolean( 'internet' )->default( 1 );
								$table->date( 'admission_date' )->nullable();
								$table->string( 'status' )->default( 'Pending' );
								$table->string( 'comments' )->nullable();
								$table->date( 'struck_off_date' )->nullable();
								$table->bigInteger( 'registration_fee' );
								$table->bigInteger( 'monthly_fee' );
								$table->boolean( 'card_status' )->default( 0 );
								$table->string( 'password' )->default( Hash::make( 'student' ) );
								$table->timestamps();
						} );
				}
				
				/**
					* Reverse the migrations.
					* @return void
					*/
				public function down()
				{
						Schema::dropIfExists( 'students' );
				}
				
		};
