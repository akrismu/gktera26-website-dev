<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MinistryResource\Pages;
use App\Models\Ministry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Resources\Concerns\Translatable;

class MinistryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Ministry::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'Ministries';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Info')
                    ->schema([
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
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Slug (URL)')
                            ->helperText('Same for all languages, e.g. koinonia'),

                        Forms\Components\Textarea::make('short_description')
                            ->rows(2)
                            ->maxLength(500)
                            ->label('Short Description')
                            ->helperText('Shown on ministry listing page')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Full Description')
                            ->columnSpanFull(),

                        CuratorPicker::make('banner_media_id')
                            ->label('Banner Image')
                            ->buttonLabel('Select Banner')
                            ->size('sm')
                            ->listDisplay(),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->label('Display Order'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Sub-Departments')
                    ->description('Add the sub-departments within this ministry')
                    ->schema([
                        Forms\Components\Repeater::make('sub_departments')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->label('Department Name'),

                                Forms\Components\Textarea::make('description')
                                    ->rows(2)
                                    ->label('Description'),

                                Forms\Components\Repeater::make('programs')
                                    ->simple(
                                        Forms\Components\TextInput::make('program')
                                            ->required()
                                            ->label('Program'),
                                    )
                                    ->defaultItems(1)
                                    ->label('Programs')
                                    ->addActionLabel('Add Program'),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->defaultItems(0)
                            ->addActionLabel('Add Sub-Department')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Goals & Projects')
                    ->schema([
                        Forms\Components\Repeater::make('goals')
                            ->simple(
                                Forms\Components\TextInput::make('goal')
                                    ->required()
                                    ->label('Goal'),
                            )
                            ->defaultItems(0)
                            ->addActionLabel('Add Goal')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Gallery')
                    ->schema([
                        Forms\Components\Repeater::make('images')
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
                            ->defaultItems(0)
                            ->addActionLabel('Add Image'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('banner_media_id')
                    ->label('Banner')
                    ->size(40),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
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
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMinistries::route('/'),
            'create' => Pages\CreateMinistry::route('/create'),
            'edit' => Pages\EditMinistry::route('/{record}/edit'),
        ];
    }
}
