<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function editProfile(Request $request){
		
		$user = User::findOrFail($request->id);
		$user->profile()->create([
			'wechat' => $request->wechat,
			'phone' => $request->phone,
			'alipay' => $request->alipay,
		]);
		return response()->json(200);
	}

	public function verify(Request $request){
		if($request->token != null){
			$token = $request->token;
			$user = User::where('token', $token)->firstOrFail();
			$user->status = 'pending';
			$user->save();
			return $user;
		}
	}
}
