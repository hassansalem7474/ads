<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertiserRequest;
use App\Http\Resources\AdvertiserResource;
use App\Jobs\SendMail;
use App\Models\Ad;
use App\Models\Advertiser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdvertiserController extends Controller
{
    public function index()
    {
        $advertisers = Advertiser::get();
        if(count($advertisers)){
            return $this->response(200, "", AdvertiserResource::collection($advertisers));   
        }
            return $this->response(404, "advertisers is empty", null);
    }


    public function store(AdvertiserRequest $request)
    {
        $advertiser = Advertiser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            ]);
        return $this->response(200, "advertiser is saved", new AdvertiserResource($advertiser));     
    }


    public function show(Advertiser $advertiser)
    {
        return $this->response(200, "", new AdvertiserResource($advertiser));     
    }


    public function update(AdvertiserRequest $request, Advertiser $advertiser)
    {
        $advertiser->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            ]);
        return $this->response(200, "advertiser is updated", new AdvertiserResource($advertiser));     
    }


    public function destroy(Advertiser $advertiser)
    {
        $advertiser->delete();
        return $this->response(200, "advertiser is deleted", new AdvertiserResource($advertiser));     
    }

    

    public function send_mail()
    {
        $ads = Ad::with('advertiser')->where('start_date',Carbon::tomorrow())->get();
        
        $emails = [];
        
        foreach($ads as $ad){
            array_push($emails,$ad->advertiser->email);
        }
        
        SendMail::dispatch($emails);

        return $this->response(200, "remainder email is sent", null);     
    }
}