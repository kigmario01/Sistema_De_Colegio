<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\Pages;
use App\Models\AcademicPeriod;
use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\Student;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Académico';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Select::make('student_id')->label('Estudiante')->options(Student::all()->pluck('first_name', 'id'))->searchable()->required(),
                Select::make('classroom_id')->label('Aula')->options(Classroom::all()->pluck('name', 'id'))->required(),
                Select::make('academic_period_id')->label('Periodo')->options(AcademicPeriod::all()->pluck('name', 'id'))->required(),
                DatePicker::make('enrolled_at')->required(),
                TextInput::make('status')->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.full_name')->label('Estudiante')->searchable(),
                TextColumn::make('classroom.name')->label('Aula'),
                TextColumn::make('academicPeriod.name')->label('Periodo'),
                TextColumn::make('enrolled_at')->date(),
                TextColumn::make('status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEnrollments::route('/'),
        ];
    }
}
