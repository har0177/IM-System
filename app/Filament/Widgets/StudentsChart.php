<?php
		
		namespace App\Filament\Widgets;
		
		use App\Models\Customer;
		use App\Models\Student;
		use App\Models\User;
		use Carbon\Carbon;
		use Filament\Widgets\ChartWidget;
		class StudentsChart extends ChartWidget
		{
				
				protected static ?string $heading = 'Total Students';
				
				protected static ?int $sort = 2;
				
				protected function getType() : string
				{
						return 'line';
				}
				
				protected function getData() : array
				{
						$students = Student::select( 'created_at' )->get()->groupBy( function( $student ) {
								return Carbon::parse( $student->created_at )->format( 'F' );
						} );
						$count = [];
						foreach( $students as $value ) {
								array_push( $count, $value->count() );
						}
						
						return [
								'datasets' => [
										[
												'label' => 'Student Admitted',
												'data'  => $count,
										],
								],
								'labels'   => $students->keys(),
						];
				}
				
		}