<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Seguimiento';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Select::make('student_id')->label('Estudiante')->options(Student::all()->pluck('first_name', 'id'))->searchable()->required(),
                Select::make('classroom_id')->label('Aula')->options(Classroom::all()->pluck('name', 'id'))->required(),
                Select::make('subject_id')->label('Materia')->options(Subject::all()->pluck('name', 'id'))->required(),
                Repeater::make('partial_score')
                    ->label('Notas parciales')
                    ->schema([
                        TextInput::make('valor')->numeric()->minValue(0)->maxValue(20)->required(),
                    ])
                    ->simple()
                    ->defaultItems(3)
                    ->required(),
                TextInput::make('final_grade')->numeric()->minValue(0)->maxValue(20),
                Textarea::make('observations')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.full_name')->label('Estudiante')->searchable(),
                TextColumn::make('subject.name')->label('Materia'),
                TextColumn::make('final_grade')->label('Nota final')->sortable(),
                BadgeColumn::make('status')->colors([
                    'success' => 'aprobado',
                    'danger' => 'reprobado',
                    'warning' => 'pendiente',
                ]),
            ])
            ->filters([
                SelectFilter::make('classroom_id')->label('Aula')->options(Classroom::all()->pluck('name', 'id')),
                SelectFilter::make('subject_id')->label('Materia')->options(Subject::all()->pluck('name', 'id')),
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
            'index' => Pages\ManageGrades::route('/'),
        ];
    }
}
