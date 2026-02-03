<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Resources\Concerns\Translatable;

class EmployeeResource extends Resource
{
    use Translatable;

    protected static ? string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Content';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        // Translatable Name
                        Forms\Components\TextInput:: make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),
                        
                        // Translatable Position
                        Forms\Components\TextInput::make('position')
                            ->required()
                            ->placeholder('e.g., Pastor / Pendeta')
                            ->maxLength(255)
                            ->label('Position'),
                        
                        // Department - Not translatable
                        Forms\Components\Select::make('department')
                            ->options([
                                'sinode' => 'Sinode',
                                'ministry' => 'Ministry',
                                'admin' => 'Administration',
                            ])
                            ->placeholder('Select Department')
                            ->label('Department'),
                        
                        // Photo - Not translatable
                        CuratorPicker::make('photo_media_id')
                            ->label('Photo')
                            ->buttonLabel('Select Photo')
                            ->size('sm')
                            ->listDisplay(),
                        
                        // Translatable Bio
                        Forms\Components\Textarea::make('bio')
                            ->rows(4)
                            ->label('Biography')
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->label('Display Order'),
                        
                        Forms\Components\Toggle::make('is_chairman')
                            ->label('Is Chairman/Leader')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('photo_media_id')
                    ->label('Photo')
                    ->size(50)
                    ->circular(),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('department')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sinode' => 'info',
                        'ministry' => 'success',
                        'admin' => 'warning',
                        default => 'gray',
                    }),
                
                Tables\Columns\IconColumn::make('is_chairman')
                    ->boolean()
                    ->label('Chairman'),
                
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->options([
                        'sinode' => 'Sinode',
                        'ministry' => 'Ministry',
                        'admin' => 'Administration',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee:: route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}