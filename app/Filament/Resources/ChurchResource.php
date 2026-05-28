<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChurchResource\Pages;
use App\Models\Church;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Resources\Concerns\Translatable;

class ChurchResource extends Resource
{
    use Translatable;

    protected static ?string $model = Church::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'Content';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, Forms\Get $get) {
                                if (! $get('slug')) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->maxLength(255)
                            ->label('Church Name'),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Slug (URL)')
                            ->helperText('This will be same for all languages'),

                        Forms\Components\TextInput::make('village')
                            ->maxLength(255)
                            ->label('Village')
                            ->helperText('Village name for geocoding'),
                        
                        Forms\Components\Textarea::make('short_description')
                            ->rows(2)
                            ->maxLength(500)
                            ->label('Short Description')
                            ->helperText('One sentence description for listing cards')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        
                        CuratorPicker::make('banner_media_id')
                            ->label('Banner Image')
                            ->buttonLabel('Select Banner')
                            ->size('sm')
                            ->listDisplay(),

                        CuratorPicker::make('preview_media_id')
                            ->label('Preview Image')
                            ->buttonLabel('Select Preview')
                            ->size('sm')
                            ->listDisplay()
                            ->helperText('Thumbnail shown in church listing'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
                
                // Location - Not translatable (coordinates are same)
                Forms\Components\Section::make('Location')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->numeric()
                            ->step(0.0000000000000001)
                            ->placeholder('e.g., -6.2088')
                            ->label('Latitude'),
                        
                        Forms\Components\TextInput::make('longitude')
                            ->numeric()
                            ->step(0.0000000000000001)
                            ->placeholder('e.g., 106.8456')
                            ->label('Longitude'),
                    ])->columns(2),
                
                // Services - Translatable
                Forms\Components\Section::make('Services')
                    ->schema([
                        Forms\Components\Repeater::make('services')
                            ->relationship()
                            ->schema([
                                // This will show in both languages when you switch tabs
                                Forms\Components\TextInput::make('service')
                                    ->required()
                                    ->placeholder('e.g., Sunday Service 08:00 AM / Ibadah Minggu 08:00')
                                    ->label('Service Description'),
                                
                                Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Display Order'),
                            ])
                            ->orderColumn('order')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ? string => $state['service'] ??  null)
                            ->defaultItems(0),
                    ]),
                
                // Contact - Not translatable (contact info is same)
                Forms\Components\Section:: make('Contact Information')
                    ->schema([
                        Forms\Components\Repeater::make('contact')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->placeholder('Contact Person Name')
                                    ->label('Name'),
                                
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->placeholder('+62 xxx xxxx xxxx')
                                    ->label('Phone'),
                                
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->placeholder('church@example.com')
                                    ->label('Email'),
                                
                                Forms\Components\Textarea::make('address')
                                    ->rows(3)
                                    ->placeholder('Full address')
                                    ->label('Address'),
                            ])
                            ->maxItems(1)
                            ->collapsible()
                            ->defaultItems(0),
                    ]),
                
                // Gallery - Not translatable (images are same)
                Forms\Components\Section::make('Gallery')
                    ->schema([
                        Forms\Components\Repeater:: make('images')
                            ->relationship()
                            ->schema([
                                CuratorPicker::make('media_id')
                                    ->label('Image')
                                    ->buttonLabel('Select Image')
                                    ->size('sm')
                                    ->listDisplay()
                                    ->required(),
                                
                                Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Display Order'),
                            ])
                            ->orderColumn('order')
                            ->collapsible()
                            ->columns(2)
                            ->defaultItems(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                CuratorColumn::make('banner_media_id')
                    ->label('Banner')
                    ->size(40),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChurches::route('/'),
            'create' => Pages\CreateChurch:: route('/create'),
            'edit' => Pages\EditChurch:: route('/{record}/edit'),
        ];
    }
}