<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassroomResource\Pages;
use App\Models\AcademicPeriod;
use App\Models\Classroom;
use App\Models\Subject;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Académico';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('grade_level')->required(),
                    TextInput::make('section')->required(),
                    TextInput::make('capacity')->numeric()->required(),
                ]),
                Select::make('academic_period_id')
                    ->label('Periodo académico')
                    ->options(AcademicPeriod::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('subjects')
                    ->multiple()
                    ->relationship('subjects', 'name')
                    ->options(Subject::all()->pluck('name', 'id')),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('grade_level')->label('Grado'),
                TextColumn::make('section')->label('Sección'),
                TextColumn::make('academicPeriod.name')->label('Periodo'),
                TextColumn::make('students_count')->counts('students')->label('Estudiantes'),
            ])
            ->filters([
                SelectFilter::make('academic_period_id')->label('Periodo')->options(AcademicPeriod::all()->pluck('name', 'id')),
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
            'index' => Pages\ManageClassrooms::route('/'),
        ];
    }
}
