<?php

namespace App\Http\Controllers;

use App\Models\CommutingMethodsModel;
use App\Models\DietaryPreferencesModel;
use App\Models\EnergySourceModel;
use App\Models\User;
use App\Models\UserDetailModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    public function loginAttempt(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');
        $remember = $request->remember;
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->back()->with([
            'error' => 'Invalid credentials'
        ]);
    }


    public function register()
    {
        $data = [
            'cm' => CommutingMethodsModel::all(),
            'es' => EnergySourceModel::all(),
            'dp' => DietaryPreferencesModel::all(),
        ];
        return view('auth.register', $data);
    }

    public function registerAttempt(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'commuting_method_id' => 'required|exists:commuting_methods,id',
            'energy_source_id' => 'required|exists:energy_sources,id',
            'dietary_preference_id' => 'required|exists:dietary_preferences,id'
        ]);
        DB::beginTransaction();
        try {
            $userCreate = User::create([
                'name' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password)
            ]);
            $userCreate->assignRole('user');
            UserDetailModel::create([
                'user_id' => $userCreate->id,
                'commuting_method_id' => $request->commuting_method_id,
                'energy_source_id' => $request->energy_source_id,
                'dietary_preference_id' => $request->dietary_preference_id
            ]);
            DB::commit();
            return redirect()->route('login')->with([
                'success' => "User $request->username has been created successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
