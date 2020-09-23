<?php

namespace App\Http\Controllers\admin\acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Plan;


class PlanProfileController extends Controller
{
    protected $plan, $profile;


    public function __construct(Plan $plan, Profile $profile){
        $this->plan = $plan;
        $this->profile = $profile;
        $this->middleware(['can:Plans']);
    }


    public function profiles($idPlan){

        if(!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
    }

    public function plans($idProfile){

        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));

    }

    public function profilesAvailable(Request $request, $idPlan){

        if(!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

        $filter = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('profiles', 'plan', 'filter'));
    }

    public function attachProfilesPlan(Request $request, $idPlan){

        if(!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0){
            return redirect()->back()->with('info', 'Precisa escolher pelo menos um Plano');
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }


    public function detachProfilePlan($idPlan, $idProfile){

        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if(!$plan || !$profile){
            return redirect()->back();
        }
        
        $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);
    }
}
