<?php
		
		use Illuminate\Database\Migrations\Migration;
		use Illuminate\Database\Schema\Blueprint;
		use Illuminate\Support\Facades\Schema;
		return new class extends Migration {
				
				/**
					* Run the migrations.
					* @return void
					*/
				public function up()
				{
						Schema::create( 'fees', function( Blueprint $table ) {
								$table->id();
								$table->foreignIdFor( \App\Models\Student::class, 'student_id' );
								$table->string( 'rec_no' );
								$table->string( 'month' );
								$table->integer( 'year' );
								$table->bigInteger( 'fee' );
								$table->bigInteger( 'concession' )->default( 0 );
								$table->bigInteger( 'other' )->nullable();
								$table->string( 'comments' )->nullable();
								$table->bigInteger( 'total' );
								$table->bigInteger( 'paid' )->default( 0 );
								$table->bigInteger( 'due' )->default( 0 );
								$table->string( 'status' )->default( 'Unpaid' );
								$table->date( 'submission_date' );
						} );
				}
				
				/**
					* Reverse the migrations.
					* @return void
					*/
				public function down()
				{
						Schema::dropIfExists( 'fees' );
				}
				
		};
