<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Académico';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('first_name')->required()->maxLength(120),
                    TextInput::make('last_name')->required()->maxLength(120),
                ]),
                Grid::make()->schema([
                    TextInput::make('document_type')->required()->maxLength(10),
                    TextInput::make('document_number')->required()->unique(ignoreRecord: true),
                    DatePicker::make('birth_date')->required(),
                    Select::make('gender')->options([
                        'masculino' => 'Masculino',
                        'femenino' => 'Femenino',
                        'otro' => 'Otro',
                    ]),
                ]),
                Grid::make()->schema([
                    TextInput::make('address')->maxLength(255),
                    TextInput::make('phone')->tel(),
                    TextInput::make('email')->email(),
                ]),
                Grid::make()->schema([
                    TextInput::make('current_grade')->required(),
                    TextInput::make('current_section')->required(),
                    TextInput::make('school_year')->required(),
                    Select::make('status')->options([
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo',
                    ])->required(),
                ]),
                Grid::make()->schema([
                    TextInput::make('guardian_name')->required(),
                    TextInput::make('guardian_phone'),
                    TextInput::make('guardian_email')->email(),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->label('Estudiante')->searchable()->sortable(),
                TextColumn::make('document_number')->label('Documento')->searchable(),
                TextColumn::make('current_grade')->label('Grado')->sortable(),
                TextColumn::make('current_section')->label('Sección'),
                BadgeColumn::make('status')->colors([
                    'success' => 'activo',
                    'danger' => 'inactivo',
                ]),
            ])
            ->filters([
                SelectFilter::make('current_grade')->label('Grado')->options(fn () => Student::query()->distinct()->pluck('current_grade', 'current_grade')),
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
            'index' => Pages\ManageStudents::route('/'),
        ];
    }
}
