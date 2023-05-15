<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
