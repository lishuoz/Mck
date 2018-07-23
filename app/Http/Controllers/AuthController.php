<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Mail\RegisterConfirmation;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
	public function register(Request $request){

		$validatedData = $request->validate([
			'name' => 'required|string|max:255|min:4|unique:users',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);

		$token = time().str_random(25);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'token' => $token,
		]);

		$accessToken = $user->createToken('login')->accessToken;

        $user->roles()->attach(2);
		// Mail::to($user)->send(new RegisterConfirmation($token));

		return response()->json([
            'user' => $user,
            'token' => $accessToken
        ], 200);
	}

	public function login(Request $request){
		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
            // Authentication passed...
			$user = auth()->user();
			// return $user;
			$token = $user->createToken('login')->accessToken;
			return response()->json([
            	'user' => $user,
            	'token' => $token
        	], 200);
		}
		return response()->json([],401);
	}


    /**
     * Logout a user and delete his oauth token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {	
		// return $request->all();
        DB::table('oauth_access_tokens')->where('user_id', $request->id)->delete();

        return response()->json(['message' => 'You are Logged out.'], 200);
    }

	// /**
    //  * Get the failed login response instance.
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  * @return \Symfony\Component\HttpFoundation\Response
    //  *
    //  * @throws ValidationException
    //  */
    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     throw ValidationException::withMessages([
    //         $this->username() => [trans('auth.failed')],
    //     ]);
    // }
}
