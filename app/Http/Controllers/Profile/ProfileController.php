<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Resources\UserResource as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
    * Get Login User
    *
    *
    * @param Request $request
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function me(Request $request)
    {
        $user = Auth::user();

        $data = new UserResource($user);

        return response()->json(compact('data'));
    }

    /**
    * Update Profile
    *
    *
    * @param UpdateProfileRequest $request
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->only(User::NAME, User::EMAIL));

        $data = new UserResource($user);

        return response()->json(compact('data'));
    }

    /**
    * Update Profile
    *
    *
    * @param Request $request
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            User::PASSWORD => 'required|confirmed|min:8',
        ]);

        $user = $request->user();

        $user->update([
            User::PASSWORD => bcrypt($request->password),
        ]);

        $data = new UserResource($user);

        return response()->json(compact('data'));
    }
}
