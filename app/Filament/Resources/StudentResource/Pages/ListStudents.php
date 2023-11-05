<?php
		
		namespace App\Filament\Resources\StudentResource\Pages;
		
		use App\Enums\StudentStatus;
		use App\Filament\Resources\StudentResource;
		use Filament\Actions;
		use Filament\Resources\Pages\ListRecords;
		class ListStudents extends ListRecords
		{
				
				protected static string $resource = StudentResource::class;
				
				
				public function getTabs() : array
				{
						$tabs = [
								null => ListRecords\Tab::make( 'All' ),
						];
						foreach( StudentStatus::cases() as $status ) {
								$tabs[ $status->value ] = ListRecords\Tab::make()
								                                         ->label( StudentStatus::from( $status->value )->getLabel() )
								                                         ->query( fn( $query ) => $query->where( 'status', $status->value ) );
						}
						
						return $tabs;
				}
				
				protected function getHeaderActions() : array
				{
						return [
								Actions\CreateAction::make(),
						];
				}
				
		}
