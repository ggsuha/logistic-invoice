<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        /**
         * @var \App\Models\User
         */
        $user = auth()->user();

        $user->load(['detail']);

        return inertia('admin.user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            /**
             * @var \App\Models\User
             */
            $user = auth()->user();
            $user->name = $request->name;

            $user->detail()->updateOrCreate([
                'phone' => $request->phone,
                'address' => $request->address,
                'header' => $request->header,
            ]);

            if ($file = $request->file('logo')) {
                Storage::deleteDirectory($user->email);
                $image = Storage::put($user->email, $file);

                $user->detail()->update([
                    'logo' => $image,
                    'logo_url' => Storage::url($image)
                ]);
            }

            $user->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->back();
    }
}
