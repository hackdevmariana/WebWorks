<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Works\Web\Models\CssVariable;
use App\Filament\Resources\CssVariableResource\Pages;

class CssVariableResource extends Resource
{
    protected static ?string $model = CssVariable::class;

    protected static ?string $navigationIcon = 'gmdi-color-lens-r';

    protected static ?string $navigationGroup = 'CSS';

    public static function getModelLabel(): string
    {
        return 'CSS Color'; // Nombre en singular
    }

    public static function getPluralModelLabel(): string
    {
        return 'CSS Colors';
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('keywords')
                    ->label('Keywords')
                    ->helperText('Enter a keyword to generate --variable automatically.')
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            // Generar slug a partir del texto ingresado
                            $slug = '--' . str_replace(' ', '-', strtolower(trim($state)));
                            $set('key', $slug);

                            // Generar el slug para la versión RGB
                            $slugRgb = $slug . '-rgb';
                            $set('key_rgb', $slugRgb);
                        }
                    }),


                Forms\Components\TextInput::make('key')
                    ->label('CSS Variable (Hexadecimal)')
                    ->disabled(),

                Forms\Components\ColorPicker::make('value')
                    ->label('Color Value')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $rgbValue = self::hexToRgb($state);
                            $set('value_rgb', $rgbValue);
                        }
                    }),




                Forms\Components\TextInput::make('key_rgb')
                    ->label('CSS Variable (RGB)')
                    ->disabled(),

                Forms\Components\TextInput::make('value_rgb')
                    ->label('Color RGB')
                    ->disabled(),


                Forms\Components\Select::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
            ])
            ->columns(1);
    }



    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('CSS Variable')
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Color Value')
                    ->formatStateUsing(function ($state) {
                        // Comprobar si el estado comienza con '#' (color hexadecimal)
                        if (str_starts_with($state, '#')) {
                            return '<div style="display: inline-block; background-color: ' . $state . '; border-radius: 5px; margin-right: 10px; padding-left: 15px; padding-right: 15px;">' . $state . '</div>';
                        }

                        // Comprobar si el estado es un color en formato RGB (número, número, número)
                        if (preg_match('/^\d{1,3},\s?\d{1,3},\s?\d{1,3}$/', $state)) {
                            return '<div style="display: inline-block; background-color: rgb(' . $state . '); border-radius: 5px; margin-right: 10px; padding-left: 15px; padding-right: 15px;">RGB(' . $state . ')</div>';
                        }

                        // Si el formato no es válido, devolver el estado como texto simple
                        return $state;
                    })
                    ->html(),


                Tables\Columns\TextColumn::make('web.name')
                    ->label('Web')
                    ->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListCssVariables::route('/'),
            'create' => Pages\CreateCssVariable::route('/create'),
            'edit' => Pages\EditCssVariable::route('/{record}/edit'),
        ];
    }

    public static function hexToRgb(string $hex): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = preg_replace('/(.)/', '$1$1', $hex);
        }
        $rgb = sscanf($hex, "%02x%02x%02x");
        return implode(', ', $rgb);
    }

    public static function saveCssVariables(array $data)
    {
        // Guardar la variable CSS en formato hexadecimal
        CssVariable::create([
            'key' => $data['key'],
            'value' => $data['value'],
            'keywords' => $data['keywords'],
            'web_id' => $data['web_id'],
            'type' => 'color',
        ]);

        $key = '--' . str_replace(' ', '-', strtolower($data['key']));
        $rgbValue = self::hexToRgb($data['value_rgb']);


        CssVariable::create([
            'key' => $key,
            'value' => $rgbValue,
            'keywords' => $data['keywords'],
            'web_id' => $data['web_id'],
            'type' => 'color',
        ]);
    }
    public static function afterSave($record)
    {
        // Obtener los datos del registro recién creado
        $data = $record->toArray();

        // Crear el segundo registro con el sufijo '-rgb'
        $key_rgb = $data['key'] . '-rgb';
        $rgbValue = self::hexToRgb($data['value']);

        // Crear la entrada para el color RGB
        CssVariable::create([
            'key' => $key_rgb,
            'value' => $rgbValue,
            'keywords' => $data['keywords'],
            'web_id' => $data['web_id'],
            'type' => 'color',
        ]);
    }


}
