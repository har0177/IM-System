<?php
		
		namespace App\Models;
		
		use Illuminate\Database\Eloquent\Factories\HasFactory;
		use Illuminate\Database\Eloquent\Model;
		use Illuminate\Database\Eloquent\Relations\BelongsTo;
		use Illuminate\Database\Eloquent\Relations\HasMany;
		class Student extends Model
		{
				
				use HasFactory;
				protected $fillable = [
						'reg_no', 'name', 'father_name', 'cnic', 'address',
						'contact', 'dob', 'course_id', 'qualification', 'std_of', 'from', 'to', 'employment',
						'internet', 'admission_date', 'status', 'comments', 'struck_off_date', 'card_status',
						'password', 'registration_fee', 'monthly_fee'
				];
				
				
				public function course() : BelongsTo
				{
						return $this->belongsTo( Course::class );
				}
				
		}
