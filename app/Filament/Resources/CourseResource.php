<?php
		
		namespace App\Filament\Resources;
		
		use App\Filament\Resources\CourseResource\Pages;
		use App\Filament\Resources\CourseResource\RelationManagers;
		use App\Models\Course;
		use Filament\Forms;
		use Filament\Forms\Form;
		use Filament\Resources\Resource;
		use Filament\Tables;
		use Filament\Tables\Table;
		use Illuminate\Database\Eloquent\Builder;
		use Illuminate\Database\Eloquent\SoftDeletingScope;
		class CourseResource extends Resource
		{
				
				protected static ?string $model = Course::class;
				
				protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
				
				protected static ?string $navigationGroup = 'Students';
				protected static ?int    $navigationSort  = 0;
				public static function form( Form $form ) : Form
				{
						return $form
								->schema( [
										Forms\Components\Section::make( 'Course' )
										                        ->description( 'Create / Update Course.' )
										                        ->icon( 'heroicon-m-cog' )
										                        ->schema( [
												                        Forms\Components\TextInput::make( 'name' )
												                                                  ->required()
												                                                  ->label( 'Course Name' )
												                                                  ->placeholder( 'Life Skill' )
												                                                  ->maxLength( 255 ),
												                        Forms\Components\TextInput::make( 'batch_name' )
												                                                  ->required()
												                                                  ->placeholder( 'Jasmine' )
												                                                  ->label( 'Batch Name' )
												                                                  ->maxLength( 255 ),
												                        Forms\Components\Toggle::make( 'status' )
												                                               ->required(),
										                        ] )
								] );
				}
				
				public static function table( Table $table ) : Table
				{
						return $table
								->columns( [
										Tables\Columns\TextColumn::make( 'name' )
										                         ->searchable(),
										Tables\Columns\TextColumn::make( 'batch_name' )
										                         ->searchable(),
										Tables\Columns\IconColumn::make( 'status' )
										                         ->boolean(),
										Tables\Columns\TextColumn::make( 'created_at' )
										                         ->dateTime()
										                         ->sortable()
										                         ->toggleable( isToggledHiddenByDefault: true ),
										Tables\Columns\TextColumn::make( 'updated_at' )
										                         ->dateTime()
										                         ->sortable()
										                         ->toggleable( isToggledHiddenByDefault: true ),
								] )
								->filters( [
										//
								] )
								->actions( [
										Tables\Actions\EditAction::make()->label( '' )->tooltip( 'Edit Course Details' )
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
								'index'  => Pages\ListCourses::route( '/' ),
								'create' => Pages\CreateCourse::route( '/create' ),
								'edit'   => Pages\EditCourse::route( '/{record}/edit' ),
						];
				}
				
		}
