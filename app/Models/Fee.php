<?php
		
		namespace App\Models;
		
		use Illuminate\Database\Eloquent\Factories\HasFactory;
		use Illuminate\Database\Eloquent\Model;
		use Illuminate\Database\Eloquent\Relations\BelongsTo;
		class Fee extends Model
		{
				
				use HasFactory;
				protected $fillable = [
						'student_id', 'rec_no', 'month', 'year',
						'fee', 'other', 'concession', 'comments', 'total', 'paid', 'due', 'status',
						'submission_date'
				];
				
				
				public function student() : BelongsTo
				{
						return $this->belongsTo( Student::class );
				}
				
				
		}
