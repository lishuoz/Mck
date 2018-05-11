<?php

namespace App\Http\Controllers;

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
			'token' => $token
		]);

		// Mail::to($user)->send(new RegisterConfirmation($token));

		return response()->json($user, 200);
	}
}
