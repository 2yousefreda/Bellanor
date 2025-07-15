<?php

namespace App\Services;

use App\Models\Follower;
use App\Treits\HttpResponses;
use App\Http\Resources\FollowerResource;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class FollowService
{
    use HttpResponses;
    /**
     * Create a new class instance.
     */


    public function index($Request)
    {

        $type = $Request->query("type");
        if ($type == "following") {
            return $this->Success($this->GetFollowing());
        } else if ($type == "followers") {
            return $this->Success($this->GetFollowers());
        } else {
            return $this->Error('', 'Invalid type', 400);
        }
    }


    private function IsFollow($User)
    {
        $Following = Follower::where('followed_id', $User->id)->where('user_id', Auth::user()->id)->first();
        if ($Following) {


            return true;
        } else {
            return false;
        }
    }

    public function Follow($User, $Request)
    {

        if ($this->IsFollow($User)) {
            return $this->Error('', 'you are already following this user', 400);
        } elseif ($User->id == Auth::user()->id) {

            return $this->Error('', 'you can not follow yourself', 400);
        }
        $Follow = new Follower();
        $Follow->user_id = Auth::user()->id;
        $Follow->followed_id = $User->id;
        $Follow->isHidden = $Request->isHidden;
        $Follow->save();
        return $this->Success(['Follow' => UserResource::make($User)]);
    }
    public function UnFollow($User)
    {
        $follow = Follower::where('followed_id', $User->id)->where('user_id', Auth::User()->id)->first();
        if ($follow == null) {
            return $this->Error('', 'you are not following this user', 400);
        }
        $follow->delete();
        return $this->Success('', 'Unfollowed successfully');
    }

    private function GetFollowing()
    {
        $Following = Follower::where("user_id", Auth::user()->id)->with('FollowedUser')->get()->map(function ($follower) {
            //    dd($follower->id);
            return [

                'user' => $follower->FollowedUser,
                'followinfo' => $follower,
            ];
        });
        return FollowerResource::collection($Following);
    }
    private function GetFollowers()
    {
        $Followers = Follower::where("followed_id", Auth::user()->id)->with('User')->get()
            ->map(function ($follower) {
                return [

                    'user' => $follower->user,
                    'followinfo' => $follower,
                ];
            });
        return FollowerResource::collection($Followers);
    }
}
