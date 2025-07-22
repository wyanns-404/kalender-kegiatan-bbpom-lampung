<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\AgendaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgendaResource\RelationManagers;
use Filament\Tables\Actions\ActionGroup;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Agenda';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Nama Agenda')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama agenda'),
                Select::make('backgroundColor')
                    ->label('Warna')
                    ->options([
                        '#3B82F6' => 'Biru',
                        '#10B981' => 'Hijau',
                        '#F59E0B' => 'Orange',
                    ])
                    ->default('#3B82F6')
                    ->required(),
                DateTimePicker::make('start')
                    ->label('Tanggal Mulai')
                    ->placeholder('Pilih tanggal dan waktu mulai')
                    ->required()
                    ->native(false),
                DateTimePicker::make('end')
                    ->label('Tanggal Selesai')
                    ->placeholder('Pilih tanggal dan waktu selesai')
                    ->native(false),
                Toggle::make('allDay')
                    ->label('Sepanjang Hari')
                    ->default(false)
                    ->helperText('Tandai jika agenda berlangsung sepanjang hari')
                    ->columnSpanFull(),
                TextInput::make('tempat')
                    ->label('Tempat')
                    ->placeholder('Masukkan lokasi agenda')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pic')
                    ->label('PIC')
                    ->placeholder('Masukkan nama PIC')
                    ->maxLength(255)
                    ->default(null),
                Textarea::make('private_content')
                    ->label('Konten Pribadi')
                    ->placeholder('(Opsional)Masukkan konten pribadi yang tidak akan ditampilkan publik (Contoh: link rapat, kata sandi, dll)'),
                Select::make('visibility')
                    ->label('Visibilitas')
                    ->options([
                        '1' => 'Publik',
                        '0' => 'Private',
                    ])
                    ->default('1')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Nama Agenda')
                    ->limit(25)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start')
                    ->label('Tanggal')
                    ->date()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tempat')
                    ->label('Tempat')
                    ->limit(15)
                    ->searchable(),
                TextColumn::make('pic')
                    ->label('PIC')
                    ->limit(20)
                    ->searchable(),
                IconColumn::make('visibility')
                    ->label('Visibilitas')
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('setVisibilityPublic')
                        ->label('Set ke Publik')
                        ->action(fn ($records) => $records->each->update(['visibility' => '1']))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('setVisibilityPrivate')
                        ->label('Set ke Private')
                        ->action(fn ($records) => $records->each->update(['visibility' => '0']))
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
