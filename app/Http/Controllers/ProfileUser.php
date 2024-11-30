<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EnergySourceModel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CommutingMethodsModel;
use App\Models\DietaryPreferencesModel;
use App\Models\UserDetailModel;
use Illuminate\Support\Facades\DB;

class ProfileUser extends Controller
{
    //
    public function index()
    {
        $data = [
            'profile' => User::with('userDetail', 'userDetail.energySource', 'userDetail.commutingMethod', 'userDetail.dietaryPreference')
                ->find(Auth::id())
        ];
        return view('profile.index', $data);
    }
    public function edit($id)
    {
        $data = [
            'profile' => User::with('userDetail', 'userDetail.energySource', 'userDetail.commutingMethod', 'userDetail.dietaryPreference')
                ->find($id),
            'cm' => CommutingMethodsModel::all(),
            'es' => EnergySourceModel::all(),
            'dp' => DietaryPreferencesModel::all(),
        ];
        return view('profile.edit', $data);
    }

    public function update($id, Request $request)
    {

        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $userDetail = UserDetailModel::where('user_id', $id)->first();
            $userDetail->energy_source_id = $request->energy_source_id;
            $userDetail->commuting_method_id = $request->commuting_method_id;
            $userDetail->dietary_preference_id = $request->dietary_preference_id;
            $userDetail->save();
            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
