<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function confirmRegister(Request $request)
    {
        $validatedData = $request->validate([
            'defaultEmail' => 'required|email',
            'DNI' => 'required|string|max:9',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'number1' => 'required|integer|max:9',
            'number2' => 'integer|max:9',
            'address' => 'required|string|max:255',
            'photo' => 'required|string',
        ]);

        #Obtenemos el usuario que deseamos confirmar
        $user = User::find('email', $request->defaultEmail);
        if ($user != null) {
            $result = $user->update([
                'DNI' => $validatedData['DNI'],
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'phoneNumber1' => $validatedData['phoneNumber1'],
                'phoneNumber2' => $validatedData['phoneNumber2'],
                'address' => $validatedData['DNI'],
                'photo' => $validatedData['DNI'],

            ]);
            return response()->json(['user' => $result])
                ->setStatusCode(Response::HTTP_OK);
        }
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => ['Password changed succesfully'],
            ])->setStatusCode(Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => ['Password not changed'],
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
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Username or password incorrect'],
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        // FIXME: queremos dejar más dispositivos?
        // $user->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'id' => $user->id,
            'DNI' => $user->DNI,
            'name' => $user->name,
            'surname' => $user->surname,
            'phoneNumber1' => $user->phoneNumber1,
            'phoneNumber2' => $user->phoneNumber2,
            'address' => $user->address,
            'photo' => $user->photo,
            'FCTDUAL' => $user->FCTDUAL,
            'email' => $user->email,
            'department_id' => $user->department_id,
            'token' => $user->createToken($request->device_name)
                ->plainTextToken,
        ]);
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
