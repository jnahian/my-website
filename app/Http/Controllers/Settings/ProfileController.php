<?php

namespace App\Http\Controllers\Settings;

use App\Traits\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'designation' => 'nullable|string|max:200',
            'father_name' => 'nullable|string|max:200',
            'mother_name' => 'nullable|string|max:200',
            'gender' => 'nullable|string|max:1',
            'mobile' => 'nullable|numeric|digits:11',
            'dob' => 'nullable|date',
        ]);

        $updateData = $request->except(['photo', 'cv']);

        if($photo = $request->get('photo') && $request->isNewPhoto){
            $upload = Utility::base64FileUpload($photo, 'profile');

            if($upload['status']) {
                $updateData['photo'] = $upload['fileInfo']['fullPath'];
            }
        }

        return tap($user)->update($updateData);
    }

    /**
     * Update Career Objective
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateObjective(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'objective' => 'required'
        ]);

        return tap($user)->update(['objective' => $request->objective]);
    }
}
