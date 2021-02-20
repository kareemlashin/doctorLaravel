<?php

namespace App\Http\Controllers;

use App\Http\Requests\locationRequest;
use App\Http\Requests\ownerRequest;
use App\Models\gender;
use App\Models\location;
use App\Models\specialtie;

class owner extends Controller
{
    public function getAllTyes(){
        $genders=gender::get();
        $locations=location::get();
        $specialtie=specialtie::get();
        return view('owner.pages.types', compact('genders','locations','specialtie'));
    }
    public function AddGender(ownerRequest $Request)
    {
        $user = gender::where('name_en', '=', $Request->gender_en)->where('name_ar', '=', $Request->gender_ar)->first();
        if ($user == null) {

            if ($Request->file('photo')) {
                $image_name = 'gender_' . time();
                $ext = strtolower($Request->photo->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $path = 'upload/image/';
                $image_url = $path . $image_full_name;
                $success = $Request->photo->move($path, $image_full_name);
                $gender = gender::create([
                    'name_ar' => $Request->gender_ar,
                    'name_en' => $Request->gender_en,
                    'photo' => $image_url
                ]);
                return response()->json(['status' => true, 'success' => 'all ok', 'message' => $gender], 200);
            } else {
                return response()->json(['status' => false, 'photo' => 'File doesn\'t exist', 'request' => $Request->photo], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => ['exists' => 'this is Exists'
            ]], 422);
        }
    }

    public function AddLocation(locationRequest $Request)
    {
        $location = location::where('city_en', '=', $Request->city_en)->where('city_ar', '=', $Request->city_ar)->first();
        if ($location == null) {
            $locations = location::create([
                'city_ar' => $Request->city_ar,
                'city_en' => $Request->city_en,
                'country_en' => $Request->country_en,
                'country_ar' => $Request->country_ar,
                'code' => $Request->code,
                'key' => $Request->key,
            ]);
            return response()->json(['status' => true, 'success' => 'all ok', 'message' => $locations], 200);
        } else {
            return response()->json(['status' => false, 'message' => ['exists' => 'this is Exists'
            ]], 422);
        }
    }
    public function AddSpecialtie(\App\Http\Requests\specialtie $Request)
    {
        $user = specialtie::where('specialties_ar', '=', $Request->specialties_ar)->where('specialties_en', '=', $Request->specialties_en)->first();
        if ($user == null) {
            if ($Request->file('photo')) {
                $image_name = 'specialties_' . time();
                $ext = strtolower($Request->photo->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $path = 'upload/image/';
                $image_url = $path . $image_full_name;
                $success = $Request->photo->move($path, $image_full_name);
                $gender = specialtie::create([
                    'specialties_en' => $Request->specialties_en,
                    'specialties_ar' => $Request->specialties_ar,
                    'description' => $Request->description,
                    'photo' => $image_url
                ]);
                return response()->json(['status' => true, 'success' => 'all ok', 'message' => $gender], 200);
            } else {
                return response()->json(['status' => false, 'photo' => 'File doesn\'t exist', 'request' => $Request->photo], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => ['exists' => 'this is Exists'
            ]], 422);
        }
    }
}
