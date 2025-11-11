<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Seguimiento';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                DatePicker::make('date')->required(),
                Select::make('status')->options([
                    'presente' => 'Presente',
                    'ausente' => 'Ausente',
                    'retardo' => 'Retardo',
                    'justificado' => 'Justificado',
                ])->required(),
                Select::make('student_id')->label('Estudiante')->options(Student::all()->pluck('first_name', 'id'))->searchable()->required(),
                Select::make('classroom_id')->label('Aula')->options(Classroom::all()->pluck('name', 'id'))->required(),
                Select::make('subject_id')->label('Materia')->options(Subject::all()->pluck('name', 'id'))->required(),
                Textarea::make('notes')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->date(),
                TextColumn::make('student.full_name')->label('Estudiante')->searchable(),
                TextColumn::make('classroom.name')->label('Aula'),
                TextColumn::make('subject.name')->label('Materia'),
                BadgeColumn::make('status')->colors([
                    'success' => 'presente',
                    'danger' => 'ausente',
                    'warning' => 'retardo',
                    'info' => 'justificado',
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
            'index' => Pages\ManageAttendances::route('/'),
        ];
    }
}
