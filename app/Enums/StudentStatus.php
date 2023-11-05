<?php
		
		namespace App\Enums;
		
		use Filament\Support\Contracts\HasColor;
		use Filament\Support\Contracts\HasLabel;
		enum StudentStatus: string implements HasLabel, HasColor
		{
				
				case Pending = 'pending';
				
				case Active = 'active';
				case DeActive = 'de-active';
				case StruckOff = 'struck-off';
				
				public function getLabel() : string
				{
						return match ( $this ) {
								self::Pending => 'Pending',
								self::Active => 'Active',
								self::DeActive => 'De-Active',
								self::StruckOff => 'Struck Off',
						};
				}
				
				public function getColor() : string|array|null
				{
						return match ( $this ) {
								self::Pending => 'black',
								self::DeActive => 'warning',
								self::Active => 'success',
								self::StruckOff => 'danger',
						};
				}
				
		}