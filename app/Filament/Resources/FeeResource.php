<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeResource\Pages;
use App\Filament\Resources\FeeResource\RelationManagers;
use App\Models\Fee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeeResource extends Resource
{
    protected static ?string $model = Fee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
		
		protected static ?string $navigationGroup = 'Fee';
		
		protected static ?int $navigationSort = 2;
		
		public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Forms\Components\TextInput::make('rec_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('month')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('year')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fee')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('concession')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('other')
                    ->numeric(),
                Forms\Components\TextInput::make('comments')
                    ->maxLength(255),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('paid')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('due')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('Unpaid'),
                Forms\Components\DatePicker::make('submission_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rec_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('month')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('concession')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('other')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comments')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('submission_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFees::route('/'),
            'create' => Pages\CreateFee::route('/create'),
            'edit' => Pages\EditFee::route('/{record}/edit'),
        ];
    }    
}
