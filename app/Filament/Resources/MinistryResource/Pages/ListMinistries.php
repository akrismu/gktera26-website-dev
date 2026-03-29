<?php

namespace App\Filament\Resources\MinistryResource\Pages;

use App\Filament\Resources\MinistryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListMinistries extends ListRecords
{
    use Translatable;

    protected static string $resource = MinistryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
