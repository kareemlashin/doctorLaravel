<?php

namespace App\Http\Controllers;

use App\Http\Requests\diseases;
use App\Http\Requests\MedicalTests;
use App\Http\Requests\patient;
use App\Http\Requests\Syndrome;
use App\Http\Requests\Xray;
use App\Models\diseasePatient;
use App\Models\likepost;
use App\Models\location;
use App\Models\patientSyndrome;
use App\Models\posts;
use App\Models\ratingPost;
use App\Models\tags;
use App\Models\User;
use App\Trait\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class patientController extends Controller
{
    use Image;

    public $path = 'upload/image/';


    //
    public function index()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient', 'patient.patientSyndromes', 'patient.patientDiseases'])->where('id', Auth::user()->id)->first();
        return view("patient.pages.home", compact('patient'));
    }

    public function editProfile()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        $locations = location::all();
        return view("patient.pages.editProfile", compact('patient', 'locations'));
    }


    public function patientProfile()
    {
        $patient = User::with(
            [
                'patient',
                'patient.genderPatient',
                'patient.locationPatient',
                'patient.patientSyndromes',
                'patient.patientDiseases',
                'patient.xRays',
                'patient.medicalTests'
            ])->where('id', Auth::user()->id)->first();
        return view("patient.pages.profile", compact('patient'));
    }

    public function updateProfile(patient $patient)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $patients = \App\Models\patient::where('user_id', Auth::user()->id)->first();

        if ($patient->file('profile')) {
            File::delete(public_path($patients->profile));
            $image = $this->UploadImage($this->path, $patient->profile, 'patient');
            $users = $user->update([
                'name' => $patient->name,
                'email' => $patient->email,
            ]);
            $patients = $patients->update([
                'profile' => $image,
                'birthday' => $patient->birthday,
                'gender_id' => $patient->gender_id,
                'location_id' => $patient->location_id,
                'phone' => $patient->phone
            ]);
        } else {
            $users = $user->update([
                'name' => $patient->name,
                'email' => $patient->email,
            ]);
            $patients = $patients->update([
                'birthday' => $patient->birthday,
                'gender_id' => $patient->gender_id,
                'location_id' => $patient->location_id,
                'phone' => $patient->phone
            ]);

        }
        return response()->json([
            'status' => true,
            'success' => 'success edit profile',
        ], 200);
    }

    public function createSyndrome(Syndrome $Syndrome)
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        $check = \App\Models\Syndrome::where('name_ar', $Syndrome->name_ar)->where('name_en', $Syndrome->name_en)->first();

        if ($check) {
            $patientSyndrome = patientSyndrome::where('patient_id', $patient->patient->id)->where('syndrome_id', $check->id)->first();
            if ($patientSyndrome) {
                return response()->json([
                    'status' => true,
                    'success' => 'it is exists ',
                ], 200);
            } else {
                $patientSyndrome = patientSyndrome::create([
                    'patient_id' => $patient->patient->id,
                    'syndrome_id' => $check->id
                ]);
                return response()->json([
                    'status' => true,
                    'success' => 'success add ',
                ], 200);
            }
        } else {
            $Syndromes = \App\Models\Syndrome::create([
                'name_ar' => $Syndrome->name_ar,
                'name_en' => $Syndrome->name_en,
                'description_ar' => $Syndrome->description_ar,
                'description_en' => $Syndrome->description_en
            ]);
            $patientSyndrome = patientSyndrome::create([
                'patient_id' => $patient->patient->id,
                'syndrome_id' => $Syndromes->id
            ]);

            return response()->json([
                'status' => true,
                'success' => 'success add Syndrome',
            ], 200);
        }

    }

    public function addSyndrome()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.addSyndrome', compact('patient'));
    }

    public function tableSyndromes()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient', 'patient.patientSyndromes'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.tables.tableSyndromes', compact('patient'));
    }

    public function deleteSyndromes(Request $request)
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        $patientSyndrome = patientSyndrome::where('syndrome_id', $request->id)->where('patient_id', $patient->patient->id)->first();
        $patientSyndrome->delete();
    }

    public function createDiseases(diseases $disease)
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        $check = \App\Models\diseases::where('name_ar', $disease->name_ar)->where('name_en', $disease->name_en)->first();

        if ($check) {
            $patientSyndrome = diseasePatient::where('patient_id', $patient->patient->id)->where('disease_id', $check->id)->first();
            if ($patientSyndrome) {
                return response()->json([
                    'status' => true,
                    'success' => 'it is exists ',
                ], 200);
            } else {
                $patientSyndromes = diseasePatient::create([
                    'patient_id' => $patient->patient->id,
                    'disease_id' => $check->id
                ]);
                return response()->json([
                    'status' => true,
                    'success' => 'success add ',
                ], 200);
            }
        } else {
            $disease = \App\Models\diseases::create([
                'name_ar' => $disease->name_ar,
                'name_en' => $disease->name_en,
                'description_ar' => $disease->description_ar,
                'description_en' => $disease->description_en
            ]);
            $patientSyndrome = diseasePatient::create([
                'patient_id' => $patient->patient->id,
                'disease_id' => $disease->id
            ]);

            return response()->json([
                'status' => true,
                'success' => 'success add Syndrome',
            ], 200);
        }

    }

    public function addDiseases()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.addDiseases', compact('patient'));
    }

    public function tableDiseases()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient', 'patient.patientSyndromes', 'patient.patientDiseases'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.tables.tableDiseases', compact('patient'));
    }

    public function deleteDiseases(Request $request)
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        $patientSyndrome = diseasePatient::where('disease_id', $request->id)->where('patient_id', $patient->patient->id)->first();
        $patientSyndrome->delete();
    }

    public function addMedicalTest()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.addMedicalTest', compact('patient'));
    }

    public function createMedicalTest(MedicalTests $medicalTests)
    {

        $user = User::where('id', Auth::user()->id)->first();
        $patients = \App\Models\patient::where('user_id', Auth::user()->id)->first();

        if ($medicalTests->file('image')) {
            $image = $this->UploadImage($this->path, $medicalTests->image, 'MedicalTests_');
            $MedicalTests = \App\Models\MedicalTests::create([
                'name_ar' => $medicalTests->name_ar,
                'name_en' => $medicalTests->name_en,
                'image' => $image,
                'patient_id' => $patients->id
            ]);
        }
        return response()->json([
            'status' => true,
            'success' => 'success add  Medical Tests',
        ], 200);
    }

    public function tableMedicalTest()
    {
        $patient = User::with(['patient', 'patient.medicalTests'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.tables.tableMedicalTests', compact('patient'));
    }

    public function deleteMedicalTest(Request $request)
    {
        $patient = User::with(['patient'])->where('id', Auth::user()->id)->first();
        $Xray = \App\Models\MedicalTests::where('id', $request->id)->where('patient_id', $patient->patient->id)->first();
        File::delete(public_path($Xray->image));
        $delete = $Xray->delete();
    }

    public function addXray()
    {
        $patient = User::with(['patient', 'patient.genderPatient', 'patient.locationPatient'])->where('id', Auth::user()->id)->first();
        return view('patient.pages.addXray', compact('patient'));
    }

    public function createXray(Xray $Xray)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $patients = \App\Models\patient::where('user_id', Auth::user()->id)->first();

        if ($Xray->file('image')) {
            $image = $this->UploadImage($this->path, $Xray->image, 'Xray_');
            $MedicalTests = \App\Models\Xray::create([
                'name_ar' => $Xray->name_ar,
                'name_en' => $Xray->name_en,
                'image' => $image,
                'patient_id' => $patients->id
            ]);
        }
        return response()->json([
            'status' => true,
            'success' => 'success add  Xray',
        ], 200);
    }

    public function tableXray()
    {
        $patient = User::with([
            'patient',
            'patient.xRays',
        ])->where('id', Auth::user()->id)->first();
        return view('patient.pages.tables.tableXray', compact('patient'));
    }

    public function deleteXray(Request $request)
    {
        $patient = User::with(['patient'])->where('id', Auth::user()->id)->first();
        $Xray = \App\Models\Xray::where('id', $request->id)->where('patient_id', $patient->patient->id)->first();
        File::delete(public_path($Xray->image));
        $delete = $Xray->delete();

    }

    public function posts()
    {
        $patient = User::with(['patient'])->where('id', Auth::user()->id)->first();
        $tags = tags::all();
        return view('patient.pages.posts', compact('patient', 'tags'));

    }

    public function getPosts(Request $request)
    {
        $posts = posts::with(['postTags', 'user.doctorprofile', 'postrate' => function ($q) {
        }, 'likesPost' => function ($q) {
        }])->withCount('likesPost')
            ->withCount('postrate')->withAvg('postrate', 'rate');

        if ($request->viewer) {
            $posts = $posts->orderBy('viewer', $request->viewer);
        }
        if ($request->create_at) {
            $posts = $posts->orderBy('create_at', $request->create_at);
        }
        if ($request->likes_post_count) {
            $posts = $posts->orderBy('viewer', $request->likes_post_count);
        }
        if ($request->rate) {
            $posts = $posts->orderBy('postrate_avg_rate', $request->rate);
        }
        if ($request->tags) {
            $posts = $posts->where(function ($q) use ($request) {
                $q->whereHas('postTags', function ($q) use ($request) {
                    $q->whereIn('tag_id', $request->tags);
                });
            });
        }
        if ($request->title_en) {
            $posts = $posts->orderBy('title_en', $request->title_en);
        }

        $posts = $posts->paginate(5);
        return $posts;

    }

    public function singlePost($id)
    {

        $patient = User::with(
            [
                'patient',
                'patient.genderPatient',
                'patient.locationPatient',
                'patient.patientSyndromes',
                'patient.patientDiseases',
                'patient.xRays',
                'patient.medicalTests',
                'userrate',
                'likesUserPost'
            ])->where('id', Auth::user()->id)->first();
        $post = posts::with(['postTags', 'user.doctorprofile', 'postrate' => function ($q) {
        }, 'likesPost' => function ($q) {
        }])->withCount('likesPost')
            ->withCount('postrate')->withAvg('postrate', 'rate')->find($id);

        $viewr = ++$post->viewer;
        $addView = $post->update([
            'viewer' => $viewr
        ]);
        return view('patient.pages.tables.singlPost', compact('post', 'patient'));

    }

    public function ratingPost(Request $request)
    {
        $patient = User::find(Auth::user()->id);
        $allRate = ratingPost::where('post_id', $request->post)->where('user_id', $patient->id)->first();

        if ($allRate) {
            $uprate = $allRate->update([
                'rate' => $request->rate
            ]);
        } else {
            $rate = ratingPost::create([
                'user_id' => $patient->id,
                'post_id' => $request->post,
                'rate' => $request->rate
            ]);
        }
        if ($rate || $uprate) {
            return response()->json([
                'status' => true,
                'success' => 'rate  success',
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'success' => 'please retry',
            ], 200);
        }
    }

    public function createOrRemoveLikePost(Request $request)
    {
        $patient = User::find(Auth::user()->id);
        $postHasLike = likepost::where('user_id', $patient->id)->where('post_id', $request->post)->first();
        if ($postHasLike) {
            $postHasLike = $postHasLike->delete();
        } else {
            $likepost = likepost::create([
                'user_id' => $patient->id
                , 'post_id' => $request->post
            ]);
        }
        return response()->json([
            'status' => true,
            'success' => 'please retry',
        ], 200);

    }

    public function filter(Request $request)
    {
        return $request;
    }
}
//
