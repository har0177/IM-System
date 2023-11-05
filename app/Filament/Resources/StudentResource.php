<?php
		
		namespace App\Filament\Resources;
		
		use App\Enums\StudentStatus;
		use App\Filament\Resources\StudentResource\Pages;
		use App\Models\Course;
		use App\Models\Student;
		use Filament\Forms;
		use Filament\Forms\Components\DatePicker;
		use Filament\Forms\Components\Section;
		use Filament\Forms\Components\Select;
		use Filament\Forms\Components\TextInput;
		use Filament\Forms\Components\Toggle;
		use Filament\Forms\Form;
		use Filament\Resources\Resource;
		use Filament\Tables;
		use Filament\Tables\Table;
		use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
		use Illuminate\Database\Eloquent\Builder;
		class StudentResource extends Resource
		{
				
				protected static ?string $model = Student::class;
				
				protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
				
				protected static ?string $navigationGroup = 'Students';
				
				public static function getNavigationBadge() : ?string
				{
						return static::$model::where( 'status', StudentStatus::Active )->count();
				}
				
				protected static ?int $navigationSort = 1;
				public static function form( Form $form ) : Form
				{
						return $form
								->schema( [
										Section::make( 'Student' )
										       ->description( 'Create / Update Student.' )
										       ->icon( 'heroicon-m-users' )
										       ->schema( [
												       SpatieMediaLibraryFileUpload::make( 'media' )
												                                   ->collection( 'student-images' )
												                                   ->label( 'Student Picture' )->columnSpan( 'full' ),
												       TextInput::make( 'reg_no' )
												                ->required()
												                ->unique( ignoreRecord: true )
												                ->label( 'Registration Number' )
												                ->maxLength( 255 ),
												       TextInput::make( 'name' )
												                ->required()
												                ->label( 'Student Name' )
												                ->maxLength( 255 ),
												       TextInput::make( 'father_name' )
												                ->label( 'Father Name' )
												                ->maxLength( 255 ),
												       TextInput::make( 'cnic' )
												                ->label( 'CNIC / Form B Number' )
												                ->maxLength( 255 ),
												       TextInput::make( 'address' )
												                ->label( 'Address' )
												                ->maxLength( 255 ),
												       TextInput::make( 'contact' )
												                ->label( 'Phone Number' )
												                ->maxLength( 255 ),
												       DatePicker::make( 'dob' )->label( 'Date of Birth' ),
												       Select::make( 'course_id' )
												             ->label( 'Course' )
												             ->relationship( 'course', 'name', fn( Builder $query ) => $query->where( 'status', 1 ) )
												             ->searchable()
												             ->preload()
												             ->required()->reactive(),
												       TextInput::make( 'registration_fee' )
												                ->required()
												                ->label( 'Registration Fee' )
												                ->numeric(),
												       TextInput::make( 'monthly_fee' )
												                ->required()
												                ->label( 'Monthly Fee' )
												                ->numeric(),
												       DatePicker::make( 'admission_date' )
												                 ->required()
												                 ->label( 'Admission Date' )
												                 ->default( now() ),
												       Select::make( 'status' )
												             ->searchable()
												             ->options( StudentStatus::class )
												             ->default( StudentStatus::Pending )
												             ->required(),
												       TextInput::make( 'qualification' )
												                ->placeholder( 'MS, BS etc' )
												                ->maxLength( 255 ),
												       TextInput::make( 'std_of' )
												                ->label( 'Student of' )
												                ->placeholder( 'Specialization like Botany, Zoology etc' )
												                ->maxLength( 255 ),
												       Toggle::make( 'employment' )
												             ->label( 'Currently Working?' ),
												       Toggle::make( 'internet' )
												             ->label( 'Use Internet?' ),
												       Toggle::make( 'card_status' )
												             ->label( 'Card Printed?' )->hiddenOn( 'create' ),
												       Forms\Components\MarkdownEditor::make( 'comments' )
												                                      ->columnSpan( 'full' ),
										       ] )->columns( 2 )
								] );
				}
				
				public static function table( Table $table ) : Table
				{
						return $table
								->columns( [
										Tables\Columns\SpatieMediaLibraryImageColumn::make( 'student-image' )
										                                            ->label( 'Image' )
										                                            ->collection( 'student-images' ),
										Tables\Columns\TextColumn::make( 'reg_no' )
										                         ->searchable()->sortable(),
										Tables\Columns\TextColumn::make( 'name' )
										                         ->searchable()->sortable(),
										Tables\Columns\TextColumn::make( 'father_name' )
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'cnic' )
										                         ->toggleable()
										                         ->searchable()->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'contact' )
										                         ->toggleable()
										                         ->searchable()->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'course.name' )
										                         ->numeric()
										                         ->sortable(),
										Tables\Columns\TextColumn::make( 'qualification' )
										                         ->searchable()
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'std_of' )->label( 'Student of' )
										                         ->searchable()
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'admission_date' )
										                         ->date()
										                         ->toggleable()
										                         ->sortable(),
										Tables\Columns\TextColumn::make( 'struck_off_date' )
										                         ->date()
										                         ->sortable()
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
										Tables\Columns\BadgeColumn::make( 'status' )->badge(),
										Tables\Columns\TextColumn::make( 'comments' )
										                         ->searchable()
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'registration_fee' )
										                         ->numeric()
										                         ->toggleable()
										                         ->sortable()->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'monthly_fee' )
										                         ->numeric()
										                         ->toggleable()
										                         ->sortable()->toggledHiddenByDefault(),
										Tables\Columns\IconColumn::make( 'card_status' )
										                         ->toggleable()
										                         ->boolean(),
										Tables\Columns\TextColumn::make( 'created_at' )
										                         ->dateTime()
										                         ->sortable()
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
										Tables\Columns\TextColumn::make( 'updated_at' )
										                         ->dateTime()
										                         ->sortable()
										                         ->toggleable()
										                         ->toggledHiddenByDefault(),
								] )
								->filters( [
										Tables\Filters\SelectFilter::make( 'course' )
										                           ->relationship( 'course', 'name' )
										                           ->preload()
										                           ->multiple()
										                           ->searchable(),
										Tables\Filters\SelectFilter::make( 'status' )
										                           ->options( StudentStatus::class )
										                           ->multiple()
										                           ->searchable(),
								] )
								->actions( [
										Tables\Actions\EditAction::make()->label( '' )->tooltip( 'Edit Student Details' ),
								] );
				}
				
				public static function getRelations() : array
				{
						return [
								//
						];
				}
				
				public static function getPages() : array
				{
						return [
								'index'  => Pages\ListStudents::route( '/' ),
								'create' => Pages\CreateStudent::route( '/create' ),
								'edit'   => Pages\EditStudent::route( '/{record}/edit' ),
						];
				}
				
		}
