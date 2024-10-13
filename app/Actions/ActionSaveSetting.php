<?php

namespace App\Actions;

use GeoSot\EnvEditor\Facades\EnvEditor as EnvEditor;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Plugins\Alert;

class ActionSaveSetting
{
    use AsAction;

    public function handle(Request $request)
    {
        $check = false;
        try {

            EnvEditor::editKey('APP_NAME', setString($request->name));

            EnvEditor::editKey('APP_DEBUG', $request->debug_enable);
            EnvEditor::editKey('TELESCOPE_ENABLED', $request->telescope_enable);
            EnvEditor::editKey('DEBUGBAR_ENABLED', $request->debugbar_enable);
            EnvEditor::editKey('APP_URL', $request->url);
            EnvEditor::editKey('APP_AUTH', $request->app_auth);
            EnvEditor::editKey('CSV_DELIMITER', $request->csv_delimiter);
            EnvEditor::editKey('CSV_CHUNK', $request->csv_chunk);

            if ($request->has('logo')) {
                $file_logo = $request->file('logo');
                $extension = $file_logo->extension();
                $name = 'logo.'.$extension;
                // $name = time().'.'.$name;

                $file_logo->storeAs('/public/', $name);
                EnvEditor::editKey('APP_LOGO', $name);
            }

            if ($request->has('background')) {
                $file_background = $request->file('background');
                $extension = $file_background->extension();
                $name = 'background.'.$extension;
                // $name = time().'.'.$name;

                $file_background->storeAs('/public/', $name);
                EnvEditor::editKey('APP_BACKGROUND', $name);
            }

            Alert::update();

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());

            return $th->getMessage();
        }

        return $check;
    }
}
