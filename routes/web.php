<?php

use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Auth::routes();


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole(['doctor'])) {
            return redirect()->route('homeDoctor');
        } else if (Auth::user()->hasRole(['patient'])) {
            return redirect()->route('homePatient');
        } else if (Auth::user()->hasRole(['owner'])) {
            return redirect()->route('ownerHome');
        } else if (Auth::user()->hasRole(['SubAdmin'])) {
            return redirect()->route('homeSubAdmin');
        } else if (Auth::user()->hasRole(['Administrator'])) {
            return redirect()->route('homeAdmin');
        } else if (Auth::user()->hasRole(['guest'])) {
            return redirect()->route('home');
        } else {
            return view('home');
        }
    } else {
        return view('auth.login');
    }
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['role:doctor', 'auth'], 'prefix' => 'doctor'], function () {
    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Route::get('', 'doctorController@index')->name('homeDoctor');
        Route::get('profileDoctor', 'doctorController@profileDoctor')->name('profileDoctor');
        Route::get('editDoctor', 'doctorController@editDoctor')->name('editDoctor');
        Route::post('editomProfile', 'doctorController@editcustomProfile')->name('customProfile');
        Route::get('addspecialtiesDoctor', 'doctorController@specialtiesDoctor')->name('specialtiesDoctor');
        Route::post('addDoctorspecialties', 'doctorController@specialtiesDoctorAdd')->name('specialtiesDoctorAdd');
        Route::get('addnewOffer', 'doctorController@addnewOfferview')->name('addOffer');
        Route::post('addOfferdb', 'doctorController@addOfferdb')->name('addnewOffer');
        Route::get('addService', 'doctorController@sericeview')->name('addServiceview');
        Route::post('sericedb', 'doctorController@sericedb')->name('sericedb');
        Route::get('addeducation', 'doctorController@educationview')->name('addeducationview');
        Route::post('addeducationdb', 'doctorController@educationdb')->name('addEducation');
        Route::get('addtitle', 'doctorController@titleview')->name('addtitleview');
        Route::post('addtitledb', 'doctorController@titledb')->name('addtitle');
        Route::get('addexperience', 'doctorController@experienceview')->name('addexperienceview');
        Route::post('newexperiencedb', 'doctorController@experiencedb')->name('newexperience');
        Route::get('addtag', 'doctorController@tagview')->name('addtagview');
        Route::get('addpost', 'doctorController@postview')->name('addpostview');
        Route::post('addtagdb', 'doctorController@tagdb')->name('tagdbadd');
        Route::post('addpostdb', 'doctorController@postdb')->name('newpostdb');
        Route::get('getPosts', 'doctorController@AllPosts')->name('getAllPosts');
        Route::get('singlePost/{id}', 'doctorController@getSinglePost')->name('getSinglePost');
        Route::post('ratingPost', 'doctorController@ratingPost')->name('addRate');
        Route::post('likePost', 'doctorController@createOrRemoveLike')->name('like');
        Route::get('tableEducation', 'doctorController@viewTableEducation')->name('tableAllEducation');
        Route::get('tableService', 'doctorController@viewTableService')->name('tableAllService');
        Route::get('tableExperience', 'doctorController@viewTableExperience')->name('tableAllExperience');
        Route::post('deleteOffer', 'doctorController@deleteOffer')->name('removeOffer');
        Route::get('editOffer/{id}', 'doctorController@editffer')->name('editffer');
        Route::post('updateOffer', 'doctorController@updateOffer')->name('updateOffer');
        Route::post('deleteEducation', 'doctorController@deleteEducation')->name('deleteEducation');
        Route::get('editEducation/{id}', 'doctorController@editEducation')->name('editEducation');
        Route::post('updateEducation', 'doctorController@updateEducation')->name('updateEducation');
        Route::post('deleteService', 'doctorController@deleteService')->name('deleteService');
        Route::get('editService/{id}', 'doctorController@editService')->name('editService');
        Route::post('updateService', 'doctorController@updateService')->name('updateService');
        Route::post('deleteExperience', 'doctorController@deleteExperience')->name('deleteExperience');
        Route::get('editExperience/{id}', 'doctorController@editExperience')->name('editExperience');
        Route::post('updateExperience', 'doctorController@updateExperience')->name('updateExperience');
        Route::get('tableOffers', 'doctorController@viewTableOffers')->name('tableAllOffers');
        Route::get('tablePosts', 'doctorController@viewTablePosts')->name('tableAllPosts');
        Route::get('editPost/{id}', 'doctorController@editPost')->name('editPost');
        Route::post('updatePost', 'doctorController@updatePost')->name('updatePost');
        Route::post('deletePost', 'doctorController@deletePost')->name('deletePost');
        Route::get('addClinic', 'doctorController@addClinic')->name('addClinic');
        Route::post('createClinic', 'doctorController@createClinic')->name('createClinic');
        Route::get('tableClinic', 'doctorController@tableClinic')->name('tableClinic');


    });
});
//

Route::group(['middleware' => ['role:patient', 'auth'], 'prefix' => 'patient'], function () {
    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Route::get('', 'patientController@index')->name('homePatient');
        Route::get('editProfilePatient', 'patientController@editProfile')->name('editProfilePatient');
        Route::post('updateProfile', 'patientController@updateProfile')->name('updateProfile');
        Route::get('patientProfile', 'patientController@patientProfile')->name('patientProfile');
        Route::post('createSyndrome', 'patientController@createSyndrome')->name('createSyndrome');
        Route::get('addSyndrome', 'patientController@addSyndrome')->name('addSyndrome');
        Route::get('tableSyndromes', 'patientController@tableSyndromes')->name('tableSyndromes');
        Route::post('deleteSyndromes', 'patientController@deleteSyndromes')->name('deleteSyndromes');


        Route::post('createDiseases', 'patientController@createDiseases')->name('createDiseases');
        Route::get('addDiseases', 'patientController@addDiseases')->name('addDiseases');
        Route::get('tableDiseases', 'patientController@tableDiseases')->name('tableDiseases');
        Route::post('deleteDiseases', 'patientController@deleteDiseases')->name('deleteDiseases');


        Route::post('createMedicalTest', 'patientController@createMedicalTest')->name('createMedicalTest');
        Route::get('addMedicalTest', 'patientController@addMedicalTest')->name('addMedicalTest');
        Route::get('tableMedicalTest', 'patientController@tableMedicalTest')->name('tableMedicalTest');
        Route::post('deleteMedicalTest', 'patientController@deleteMedicalTest')->name('deleteMedicalTest');

        Route::post('createXray', 'patientController@createXray')->name('createXray');
        Route::get('addXray', 'patientController@addXray')->name('addXray');
        Route::get('tableXray', 'patientController@tableXray')->name('tableXray');
        Route::post('deleteXray', 'patientController@deleteXray')->name('deleteXray');
        Route::get('allPosts', 'patientController@posts')->name('allPosts');
        Route::get('getPosts', 'patientController@getPosts')->name('getPosts');
        Route::get('singlePost/{id}', 'patientController@singlePost')->name('singlePost');
        Route::get('filter', 'patientController@filter')->name('filter');
        Route::post('ratingPostPatient', 'patientController@ratingPost')->name('ratingPostPatient');
        Route::post('likePostPatient', 'patientController@createOrRemoveLikePost')->name('likePostPatient');
        Route::get('pag', 'patientController@pag')->name('pag');

    });
});
//
Route::group(['middleware' => ['role:SubAdmin', 'auth'], 'prefix' => 'SubAdmin'], function () {
    Route::get('', function () {
        return view('SubAdmin.pages.home');
    })->name('homeSubAdmin');
});

Route::group(['middleware' => ['role:owner', 'auth'], 'prefix' => 'owner'], function () {

    Route::get('', function () {
        return view('owner.pages.home');
    })->name('ownerHome');

    Route::get('/gender', function () {
        return view('owner.pages.gender');
    })->name('addGender');

    Route::get('/location', function () {
        return view('owner.pages.location');
    })->name('addLocation');

    Route::get('/owner', function () {
        return view('owner.pages.home');
    })->name('homeOwner');

    Route::get('/specialties', function () {
        return view('owner.pages.specialties');
    })->name('addSpecialties');


});

Route::group(['middleware' => ['role:administrator', 'auth'], 'prefix' => 'administrator'], function () {
    Route::get('/', function () {
        return view('admin.pages.home');
    })->name('homeAdmin');
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['role:owner', 'auth'], 'prefix' => 'owner'], function () {
    Route::post('addnewGender', 'owner@AddGender')->name('AddNewGender');
    Route::post('AddLocation', 'owner@AddLocation')->name('AddNewLocation');
    Route::post('newSpecialtie', 'owner@AddSpecialtie')->name('AddNewSpecialtie');
    Route::get('Alltypes', 'owner@getAllTyes')->name('types');
});

