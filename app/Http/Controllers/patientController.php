<?php

namespace App\Http\Controllers;

use App\Http\Requests\diseases;
use App\Http\Requests\MedicalTests;
use App\Http\Requests\patient;
use App\Http\Requests\Syndrome;
use App\Http\Requests\Xray;
use App\Models\diseasePatient;
use App\Models\location;
use App\Models\patientSyndrome;
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
        $Xray=\App\Models\MedicalTests::where('id',$request->id)->where('patient_id',$patient->patient->id)->first();
        File::delete(public_path($Xray->image));
        $delete=$Xray->delete();
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
        $Xray=\App\Models\Xray::where('id',$request->id)->where('patient_id',$patient->patient->id)->first();
        File::delete(public_path($Xray->image));
        $delete=$Xray->delete();

    }

}
//

