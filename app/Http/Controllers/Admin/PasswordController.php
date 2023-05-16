<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;

class PasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordRequest $request)
    {
        /**
         * @var \App\Models\User
         */
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back();
    }
}
