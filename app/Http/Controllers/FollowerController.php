<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\FollowRequest;
use App\Services\FollowService;

class FollowerController extends Controller
{
    protected $FollowService;

    public function __construct(FollowService $FollowService)
    {
        $this->FollowService = $FollowService;
    }



    public function index(request $Request)
    {

        $this->FollowService->index($Request);
    }


    public function Follow(User $User, FollowRequest $Request)
    {
        $this->FollowService->Follow($User, $Request);
    }
    public function UnFollow(User $User)
    {
        $this->FollowService->UnFollow($User);
    }
}
