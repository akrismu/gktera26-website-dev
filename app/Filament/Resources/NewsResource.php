<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Resources\Concerns\Translatable;

class NewsResource extends Resource
{
    use Translatable;

    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
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
                        // Translatable Title
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, Forms\Get $get) {
                                if (!$get('slug')) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->maxLength(255)
                            ->label('Title'),
                        
                        // Slug - Not translatable
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Slug (URL)')
                            ->helperText('This will be same for all languages'),
                        
                        // Translatable Excerpt
                        Forms\Components\Textarea::make('excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->label('Excerpt')
                            ->columnSpanFull(),
                        
                        // Translatable Content
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->label('Content')
                            ->columnSpanFull(),
                        
                        // Featured Image - Not translatable
                        CuratorPicker:: make('featured_media_id')
                            ->label('Featured Image')
                            ->buttonLabel('Select Image')
                            ->size('sm')
                            ->listDisplay()
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(false)
                            ->live(),
                        
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->visible(fn (Forms\Get $get) => $get('is_published'))
                            ->default(now()),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('featured_media_id')
                    ->label('Image')
                    ->size(40),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),
                
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
                
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Status'),
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}