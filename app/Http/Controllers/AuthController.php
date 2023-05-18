<?php

namespace App\Http\Controllers;

use App\Helpers\HandelResponse;
use App\Helpers\StatusCodeRequest;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class AuthController extends Controller
{
    use HandelResponse;

    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['logout', 'refresh', 'userProfile']]);
    }

    /**
     * return StatusCode BAD_REQUEST if $request is Invalid
     * return StatusCode OK if user created successfully
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
            return $this->handleResponse($validator->errors(), StatusCodeRequest::BAD_REQUEST);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->handleResponse('success', StatusCodeRequest::OK);
    }

    /**
     * return StatusCode BAD_REQUEST if $request is Invalid
     * return StatusCode UNAUTHORISED if email and password is Invalid
     * return StatusCode OK if user login successfully
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
            return $this->handleResponse($validator->errors(), StatusCodeRequest::BAD_REQUEST);
        $token = Auth::attempt($request->only('email', 'password'));
        if (!$token)
            return $this->handleResponse('Unauthorized', StatusCodeRequest::UNAUTHORISED);
        $user = Auth::user();
        $user->setRememberToken($token);
        return $this->handleResponseData($user, 'success', StatusCodeRequest::OK);
    }

    /**
     * return StatusCode UNAUTHORISED if token is Invalid or Expired or not found
     * return StatusCode OK if user logout successfully
     */
    public function logout()
    {
        auth()->logout();
        return $this->handleResponse('success', StatusCodeRequest::OK);
    }

    /**
     * return StatusCode BAD_REQUEST if user not found
     * return StatusCode OK if mail is sent to user successfully
     */
    public function sendVerifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|exists:users',
        ]);
        if ($validator->fails())
            return $this->handleResponse($validator->errors(), StatusCodeRequest::BAD_REQUEST);
        $user = User::where('email', $request->email)->first();
        $user->verify_code = Random::generate(5, '0-9');
        $user->save();
        try {
            Mail::mailer('mailgun')->to($user->email)->send(new VerifyMail($user));
            return $this->handleResponse('success', StatusCodeRequest::OK);
        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * return StatusCode BAD_REQUEST if user not found or if verifyCode not correct
     * return StatusCode OK if user is verify successfully
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|exists:users',
            'verifyCode' => 'required|numeric',
        ]);
        if ($validator->fails())
            return $this->handleResponse($validator->errors(), StatusCodeRequest::BAD_REQUEST);
        $user = User::where('email', $request->email)->first();
        if ($user->verify_code != $request->verifyCode)
            return $this->handleResponse('verifyCode not Correct', StatusCodeRequest::BAD_REQUEST);
        if (!$request->has('password'))
            return $this->handleResponse('success', StatusCodeRequest::OK);
        $user->remember_token = Auth::attempt($request->only('email', 'password'));
        $user->email_verified_at = now();
        $user->save();
        return $this->handleResponseData($user, 'success', StatusCodeRequest::OK);
    }

    /**
     * return StatusCode BAD_REQUEST if user not found
     * return StatusCode OK if reset password successfully
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|exists:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
            return $this->handleResponse($validator->errors(), StatusCodeRequest::BAD_REQUEST);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        $user->remember_token = Auth::attempt($request->only('email', 'password'));
        $user->save();
        return $this->handleResponseData($user, 'success', StatusCodeRequest::OK);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }
}
