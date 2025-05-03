<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

/**
 *     @OA\Post(
 *         path="/api/login",
 *         summary="Login",
 *         tags={"User management"},
 *         @OA\RequestBody(
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                      type="object",
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="password", type="string"),
 *                 )
 *             )
 *         ),
 *         @OA\Response(response="200", description="Success"),
 *         @OA\Response(response="404", description="User not found or invalid password"),
 *     ),
 *     @OA\Post(
 *         path="/api/register",
 *         summary="Register",
 *         tags={"User management"},
 *         @OA\RequestBody(
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                      type="object",
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="password", type="string"),
 *                 )
 *             )
 *         ),
 *         @OA\Response(response="200", description="Success"),
 *         @OA\Response(response="500", description="Name already in use / Error"),
 *     ),
 */
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $success = [
            "token" => $user->createToken("Touken")->plainTextToken,
            "name" => $user->name,
        ];
        return $this->sendResponse($success, "User registered successfully.");
    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        if (
            Auth::attempt([
                "name" => $request->name,
                "password" => $request->password,
            ])
        ) {
            $user = Auth::user();
            $success = [
                "token" => $user->createToken("Touken")->plainTextToken,
                "name" => $user->name,
            ];
            return $this->sendResponse($success, "User logged in successfully.");
        } else {
            return $this->sendError("Unauthorized: username/password invalid", [
                "error" => "Unauthorized",
            ]);
        }
    }
}
