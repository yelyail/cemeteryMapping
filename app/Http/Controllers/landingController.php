<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\plotInvent;
use App\Models\deceaseInfo;

class landingController extends Controller
{
    public function dashboard()
    {
        $userId = session('signinID');
        $user = User::find($userId);
        $userName = $user->name;
        $userRole = $user->role;
        $plots = plotInvent::with('decease')->get();
        $cemeteryNames = $plots->pluck('cemName')->unique();
        $cemeteryData = [];

        $reservedPlots = $plots->whereNotNull('ownerID')->pluck('plotNum')->toArray();
        $occupiedPlots = $plots->filter(function ($plot) {
            return $plot->decease !== null;
        })->pluck('plotInventID')->toArray();

        foreach ($cemeteryNames as $cemeteryName) {
            $cemeteryPlots = $plots->where('cemName', $cemeteryName);
            $unownedPlots = $cemeteryPlots->whereNull('ownerID');
            $totalPlots = $unownedPlots->sum('plotTotal');
                $cemeteryData[$cemeteryName] = [
                    'totalPlots' => $totalPlots,
                    'plotData' => $cemeteryPlots
                ];
            }
        return view('project.Dashboard', compact('userName', 'userRole', 'cemeteryData', 'reservedPlots', 'occupiedPlots'));
    }
    public function home(){
        return view('project.home');
    }
    public function services(){
        return view('project.services');
    }
    public function faq(){
        return view('project.faq');
    }
    public function contacts(){
        return view('project.contacts');
    }
}
