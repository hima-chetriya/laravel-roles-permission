<?php

namespace App\Http\Controllers\API;


use Throwable;
use Validator;
use App\Models\User;
use phpseclib3\Crypt\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ForgotPasswordOTP;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class ApiController extends Controller
{

    // Register

    public function Register(Request $request)
    {
        try {
            $validatedData = FacadesValidator::make(
                $request->all(),
                [
                    'name' => 'required|string',
                    'email' => 'required|string|unique:users',
                    'password' => 'required|string',
                    'c_password' => 'required|same:password'
                ]
            );


            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error!',
                    'errors' => $validatedData->errors()
                ], 401);
            }

            $user = User::create([
                'name'  => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Register Successfully!',
                'errors' => $validatedData->errors()
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    // Login

    public function Login(Request $request)
    {
        try {
            $validatedData = FacadesValidator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'password' => 'required',
                ]
            );


            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error!',
                    'errors' => $validatedData->errors()
                ], 401);
            }

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('User Token');
            $token = $tokenResult->plainTextToken;
            return response()->json([
                'status' => true,
                'accessToken' => $token,
                'token_type' => 'Bearer',
                'message' => 'User Login Successfully!',
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }




    // Forgot Password

    public function ForgotPassword(Request $request)
    {
        try {
            $request->validate(
                ['email' => 'required|email']
            );

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'error' => 'User not found'
                ], 404);
            }

            $otp = mt_rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            if ($user->otp === $otp) {
                Mail::to($user->email)->send(new ForgotPasswordOTP($otp));
                return response()->json([
                        'status' => true,
                        'message' => 'OTP sent successfully'
                    ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'error' => 'Failed to save OTP'
                ], 500);
            }
        }
         catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    // verifyOTP

    public function verifyOTP(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'otp' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'error' => 'User not found'
                ], 404);
              
            }

            if ($request->otp != $user->otp) {
                return response()->json(['error' => 'Invalid OTP'], 400);
            }
            $user->otp = null;
            $user->update();
            return response()->json(['message' => 'OTP verification successful']);
        } 
        catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    // resetPassword

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                // 'otp' => 'required|integer',
                'password' => 'required|string|confirmed',
            ]);

            // $passwordReset = User::where('email', $request->email)->first();

            // if ($request->otp != $passwordReset->otp) {
            //     return response()->json([
            //         'status' => false,
            //         'error' => 'Invalid OTP'
            //     ], 400);
            // }
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'error' => 'User not found'
                ], 404);
            }

            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password reset successfully.'
            ], 200);

        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    // changePassword

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
            ]);
            $user = User::where('email', $request->email)->first();

            if (!password_verify($request->input('current_password'), $user->password)) {
                return response()->json(['error' => 'Current password is incorrect'], 422);
            }
            $user->password = bcrypt($request->input('new_password'));
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully'
            ], 200);
          
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    // Logout

    public function Logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user && $user->tokens()) {
                $user->tokens()->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully logged out',
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'User is not authenticated or token not found',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred during logout',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    // Update Profile 

    public function Profile(Request $request)
    {
        try {

            $userupdate = User::find(auth()->user()->id);
            $userupdate->name = $request->name;
            $userupdate->email = $request->email;


            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('api_images'), $imageName);
                $userupdate->image = $imageName;
            }

            $userupdate->update();
            return response()->json([
                'status' => true,
                'data' =>  $userupdate,
                // 'id' => auth()->user()->id,
                'message' => 'Profile Information update!',
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
