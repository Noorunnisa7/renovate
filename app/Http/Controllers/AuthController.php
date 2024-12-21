<?php 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\UserDetail;
use App\Models\CompanyFolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

use App\Helpers\ApiResponse;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */


    
     #View Login 
     public function viewlogin(){
        return view('auth.login');
     }
     



   

   
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            // Successful login
            return redirect('/dashboard')->with('success', 'Welcome back!');
        }
    
        // Login failed
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();

    }

    public function dashboard(Request $request)
    {
        return view('dashboard',$request);
    }
    
   
    public function me(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->withErrors('Please log in first.');
        }
        $request->merge([
            'userID' => $user->id,
            'userName' => $user->name,
            'userEmail' => $user->email,
            'userRole' => $user->role, 
        ]);
        return view('auth.profile' , $request);
    }

    
    public function logout()
    {
        $user = Auth::user();

        $cacheKey = 'user_' . $user->id;
        Cache::forget($cacheKey);
        Auth::logout();
        return redirect('/login')->with('success', 'LogOut');
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}