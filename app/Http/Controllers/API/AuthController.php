<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function confirmRegister(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'DNI' => 'required|string|max:9',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phoneNumber1' => 'required|integer',
            'phoneNumber2' => 'integer',
            'address' => 'required|string|max:255',
            'photo' => 'required|string',
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
        ]);
        #Obtenemos el usuario que deseamos confirmar
        $user = User::where('email', $validatedData['email'])->first();
        if ($user) {
            if (Hash::check($request->oldPassword, $user->password)) {
                if ($validatedData['newPassword'] == 'elorrieta00') {
                    return response()->json([
                        'message' => ['Password cannot be same as default'],
                    ])->setStatusCode(Response::HTTP_NOT_FOUND);
                }
                $user->DNI = $validatedData['DNI'];
                $user->name = $validatedData['name'];
                $user->surname = $validatedData['surname'];
                $user->phone_number1 = $validatedData['phoneNumber1'];
                $user->phone_number2 = $validatedData['phoneNumber2'];
                $user->address = $validatedData['address'];
                $user->photo = $validatedData['photo'];
                $user->password = Hash::make($validatedData['newPassword']);
                $result = $user->save();
                if ($user) {
                    return response()->json(['user' => $result])
                        ->setStatusCode(Response::HTTP_OK);
                } else {
                    return response()->json([
                        'message' => ['User has not been updated'],
                    ])->setStatusCode(Response::HTTP_NOT_FOUND);
                }
            } else {
                return response()->json([
                    'message' => ['Wrong Password'],
                ])->setStatusCode(Response::HTTP_NOT_FOUND);
            }
        } else {
            return response()->json([
                'message' => ['User that not exist'],
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'DNI' => 'required|string|max:9',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phoneNumber1' => 'required|integer',
            'phoneNumber2' => 'integer',
            'address' => 'required|string|max:255',
            'photo' => 'required|string',
        ]);

        #Obtenemos el usuario que deseamos confirmar
        $user = User::where('email', $validatedData['email'])->first();
        if ($user) {
            $user->DNI = $validatedData['DNI'];
            $user->name = $validatedData['name'];
            $user->surname = $validatedData['surname'];
            $user->phone_number1 = $validatedData['phoneNumber1'];
            $user->phone_number2 = $validatedData['phoneNumber2'];
            $user->address = $validatedData['address'];
            $user->photo = $validatedData['photo'];
            $result = $user->save();
            if ($user) {
                return response()->json(['user' => $result])
                    ->setStatusCode(Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => ['User has not been updated'],
                ])->setStatusCode(Response::HTTP_NOT_FOUND);
            }
        } else {
            return response()->json([
                'message' => ['User that not exist'],
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }
    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',

        ]);

        $user = User::where('email', $validatedData['email'])->first();
        if ($user) {
            if (Hash::check($request->oldPassword, $user->password)) {
                $user->password = Hash::make($validatedData['newPassword']);
                $response = $user->save();
                if ($response) {
                    return response()->json([
                        'message' => ['Password changed succesfully'],
                    ])->setStatusCode(Response::HTTP_OK);
                } else {
                    return response()->json([
                        'message' => ['Password not changed'],
                    ])->setStatusCode(Response::HTTP_OK);
                }
            } else {
                return response()->json([
                    'message' => ['Wrong Password'],
                ])->setStatusCode(Response::HTTP_NOT_FOUND);
            }
        } else {
            return response()->json([
                'message' => ['User does not exist'],
            ])->setStatusCode(Response::HTTP_NOT_MODIFIED);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json([
                'message' => ['Username or password incorrect'],
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        // FIXME: queremos dejar más dispositivos?
        // $user->tokens()->delete();

        $degrees = $user->degrees()->with("modules")->get();
        $roles = $user->roles()->get();

        return response()->json([
            'id' => $user->id,
            'DNI' => $user->DNI,
            'name' => $user->name,
            'surname' => $user->surname,
            'phone_number1' => $user->phone_number1,
            'phone_number2' => $user->phone_number2,
            'address' => $user->address,
            'photo' => null,
            'FCTDUAL' => $user->FCTDUAL,
            'email' => $user->email,
            'degrees' => $degrees,
            'roles' => $roles,
            // 'modules'=>$user->modules()->get(),
            'department_id' => $user->department_id,
            'token' => $user->createToken($request->device_name)
                ->plainTextToken,
        ])->setStatusCode(Response::HTTP_OK);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully'
        ])->setStatusCode(Response::HTTP_OK);
    }
}
