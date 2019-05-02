<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingsForm;
use App\UserSettings;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSettingsForm $request)
    {
        $content = $request->validated();

        $request->user()->settings['values'] = $content;
        $request->user()->settings->save();

        return response()->json([
            'success' => true,
        ]);
    }
}
