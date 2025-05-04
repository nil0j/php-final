<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SessionManager
{
    public function login(Request $request): RedirectResponse
    {
        $name = $request->input('name');
        $password = $request->input('password');
        $response = Http::post("localhost:8000/api/login", [
            'name' => $name,
            'password' => $password
        ]);

        if ($response->successful()) {
            $data = $response->json()['data'];
            $this->storeToken($data['token']);
            return redirect('/products');
        }

        return redirect('/login');
    }

    protected function storeToken($token)
    {
        session(['api_token' => $token]);
    }


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
