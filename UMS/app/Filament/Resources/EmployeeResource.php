<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Filament\Resources\AdminResource\Widgets\EmployeeWidget;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Employees';
    protected static ?string $recordTitleAttribute = 'name';



    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Employee Details')
                ->description('Enter the basic details ')
                ->schema([
                    Select::make('rank')
                        ->label('Rank')
                        ->options([
                            'Sgm' => 'Sgm',
                            'lcpl' => 'L/Cpl',
                            'cpl' => 'Cpl',
                            'sgt' => 'Sgt',
                            'ssgt' => 'S/sgt',
                            'woi' => 'WO I',
                            'woii' => 'WO II',
                        ])
                        ->required(),
                    TextInput::make('serno')
                        ->label('Service No')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('dob')
                        ->label('Date of Birth')
                        ->placeholder('Select a date')
                        ->required()
                        ->displayFormat('Y-m-d')
                        ->format('Y-m-d'),
                    FileUpload::make('image')
                        ->label('Image'),



                    Select::make('gender')
                        ->label('Gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                            'other' => 'Other',
                        ])
                        ->required(),
                        ])
                        ->columns(2),
                    Section::make('Squadron Information')
                        ->description('Provide the Squadron details')
                        ->schema([
                         Select::make('squadron')
                        ->label('Squadron')
                        ->options([
                            'HQ' => 'HQ Squadron',
                            'radio' => 'Radio Squadron ',
                            'tele' => 'Tele Squadron',
                            'computer' => 'Computer Workshop',
                            'relay' => 'RR Squadron',
                        ])
                        ->required(),
                        Select::make('position')
                        ->label('Position')
                    ->options([
                            'ssm' => 'SSM',
                            'technisian' => 'Technesian',
                            'clerk' => 'Clerk',
                            'forman' => 'Forman',
                            'di' => 'DI',
                            'rsm' => 'RSM',
                            'clerk' => 'Clerk',
                        ])
                        ->required(),
                        ])
                        ->columns(3),
            Section::make('Contact Information')
                ->description('Provide the contact details ')
                ->schema([
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->rule('email:rfc,dns')
                        ->placeholder('example@domain.com')
                        ->hint('Enter a valid email address')
                        ->hintIcon('heroicon-o-envelope')
                        ->maxLength(255),
                TextInput::make('address')
                        ->label('Address')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('teleno')
                        ->label('Mobile No')
                        ->required()
                        ->maxLength(255),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->limit(100),

            ImageColumn::make('image')
            ->label('Employee Image')
            ->width(50) // Adjust size
            ->height(50),



            Tables\Columns\TextColumn::make('rank')->limit(100),
            Tables\Columns\TextColumn::make('serno')->limit(100),
            Tables\Columns\TextColumn::make('name')->limit(100),

            Tables\Columns\TextColumn::make('image')->limit(100),
            Tables\Columns\TextColumn::make('squadron')->limit(100),
            Tables\Columns\TextColumn::make('position')->limit(100),
            Tables\Columns\TextColumn::make('email')->limit(100),
            Tables\Columns\TextColumn::make('dob')->limit(100),
            //
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }
    public static function getWidget(): array
    {
        return [
            EmployeeWidget::class,

        ];
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('name'),
                Infolists\Components\TextEntry::make('image'),
                Infolists\Components\TextEntry::make('email')
                    ->columnSpanFull(),
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
