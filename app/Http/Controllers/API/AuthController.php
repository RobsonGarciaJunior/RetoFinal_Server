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
            'email' => 'required|email',
            'DNI' => 'required|string|max:9',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phoneNumber1' => 'required|integer|max:9',
            'phoneNumber2' => 'integer|max:9',
            'address' => 'required|string|max:255',
            'photo' => 'required|string',
        ]);

        #Obtenemos el usuario que deseamos confirmar
        $user = User::find($request->email);
        $user->DNI = $validatedData['DNI'];
        $user->name = $validatedData['name'];
        $user->surname = $validatedData['surname'];
        $user->phoneNumber1 = $validatedData['phoneNumber1'];
        $user->phoneNumber2 = $validatedData['phoneNumber2'];
        $user->address = $validatedData['address'];
        $user->photo = $validatedData['photo'];
        $result = $user->save();
        if ($user) {
            return response()->json(['user' => $result])
                ->setStatusCode(Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => ['Password not changed'],
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8|confirmed',

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

        $degrees = $user->degrees()->withOnly("modules")->get();
        //unset($degrees->pivot);

        return response()->json([
            'id' => $user->id,
            'DNI' => $user->DNI,
            'name' => $user->name,
            'surname' => $user->surname,
            'phoneNumber1' => $user->phoneNumber1,
            'phoneNumber2' => $user->phoneNumber2,
            'address' => $user->address,
            'photo' => null,
            'FCTDUAL' => $user->FCTDUAL,
            'email' => $user->email,
            'degrees'=>$degrees,
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
