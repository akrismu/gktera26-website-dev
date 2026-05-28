<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Resources\Concerns\Translatable;

class BannerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
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
                        // Page Identifier - Not translatable
                        Forms\Components\Select::make('page_identifier')
                            ->label('Page')
                            ->options([
                                'home' => 'Home',
                                'about' => 'About',
                                'churches' => 'Churches',
                                'news' => 'News',
                                'sinode' => 'Sinode',
                                'history' => 'History',
                                'mission' => 'Mission',
                            ])
                            ->required()
                            ->unique(ignoreRecord: true),
                        
                        // Translatable Title
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->placeholder('Banner Title')
                            ->label('Title'),
                        
                        // Translatable Subtitle
                        Forms\Components\Textarea::make('subtitle')
                            ->rows(2)
                            ->placeholder('Banner Subtitle')
                            ->label('Subtitle'),

                        Forms\Components\Select::make('type')
                            ->options([
                                'banner' => 'Banner',
                                'other' => 'Other',
                            ])
                            ->default('banner')
                            ->required()
                            ->label('Type'),
                        
                        // Banner Image - Not translatable
                        CuratorPicker::make('media_id')
                            ->label('Banner Image')
                            ->buttonLabel('Select Banner')
                            ->size('sm')
                            ->listDisplay()
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('media_id')
                    ->label('Image')
                    ->size(80),
                
                Tables\Columns\TextColumn::make('page_identifier')
                    ->label('Page')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->wrap(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner:: route('/create'),
            'edit' => Pages\EditBanner:: route('/{record}/edit'),
        ];
    }
}