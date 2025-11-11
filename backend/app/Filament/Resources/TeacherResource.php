<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Académico';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('document_number')->required()->unique(ignoreRecord: true),
                DatePicker::make('hire_date')->required(),
                TextInput::make('specialty'),
                TextInput::make('phone')->tel(),
                TextInput::make('email')->email(),
                MultiSelect::make('subjects')
                    ->relationship('subjects', 'name')
                    ->options(Subject::all()->pluck('name', 'id')),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->label('Nombre')->searchable(),
                TextColumn::make('last_name')->label('Apellido')->searchable(),
                TextColumn::make('document_number')->label('Documento')->searchable(),
                TextColumn::make('specialty')->label('Especialidad'),
                BadgeColumn::make('subjects_count')->counts('subjects')->label('Materias'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTeachers::route('/'),
        ];
    }
}
