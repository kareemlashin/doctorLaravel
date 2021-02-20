<?php


namespace App\Http\Controllers;

use App\Http\Requests\clinic;
use App\Http\Requests\editPost;
use App\Http\Requests\education;
use App\Http\Requests\experience;
use App\Http\Requests\experienceEdit;
use App\Http\Requests\offer;
use App\Http\Requests\posts;
use App\Http\Requests\service;
use App\Http\Requests\specialtiesdoctor;
use App\Http\Requests\titlesdoctor;
use App\Models\clinicImage;
use App\Models\gender;
use App\Models\likepost;
use App\Models\location;
use App\Models\ratingPost;
use App\Models\specialtie;
use App\Models\tags;
use App\Models\tagsPosts;
use App\Models\titles;
use App\Models\User;
use App\Trait\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class doctorController extends Controller
{
    use Image;

    public function index()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        return view('doctor.pages.home', compact('doctor'));
    }

    public function specialtiesDoctor()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location', 'doctorprofile.specialtiesdoctor'])->find(Auth::user()->id);
        $specialtie = specialtie::get();
        $specDoc = \App\Models\specialtiesdoctor::where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.specialtiesDoctor', compact('doctor', 'specialtie', 'specDoc'));

    }

    public function specialtiesDoctorAdd(specialtiesdoctor $request)
    {
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $specDoc = \App\Models\specialtiesdoctor::where('profiledoctors_id', $profiledoctor->id)->delete();

        foreach ($request->specialties_id as $spc) {
            $specDoc = \App\Models\specialtiesdoctor::create([
                'specialties_id' => $spc,
                'profiledoctors_id' => $profiledoctor->id,
            ]);
        }
        return response()->json([
            'status' => true,
            'success' => 'success edit',
        ], 200);
    }

    public function profileDoctor()
    {
        $doctor = User::with(
            ['doctorprofile.gender', 'doctorprofile.location', 'doctorprofile.specialtiesdoctor', 'doctorprofile.service',
                'doctorprofile.education'
                , 'doctorprofile.offer', 'doctorprofile.titlesdoctor', 'doctorprofile.experience']
        )->find(Auth::user()->id);
        return view('doctor.pages.profile', compact('doctor'));
    }

    public function editDoctor()
    {
        $genders = gender::get();
        $locations = location::get();
        $specialtie = specialtie::get();
        $doctor = User::with('doctorprofile')->find(Auth::user()->id);
        return view('doctor.pages.editprofile', compact('doctor', 'genders', 'locations'));
    }

    public function editcustomProfile(\App\Http\Requests\profiledoctor $request)
    {
        $user = \App\Models\User::where('id', Auth::user()->id)->first();
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $path = 'upload/image/';
        if ($user && $profiledoctor) {
            if ($request->file('profile')) {
                File::delete(public_path($profiledoctor->profile));
                $image_name = 'doctor_' . time();
                $ext = strtolower($request->profile->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $image_url = $path . $image_full_name;
                $success = $request->profile->move($path, $image_full_name);
            }

            if ($request->file('header')) {
                File::delete(public_path($profiledoctor->header));
                $header_name = 'header_' . time();
                $extheader = strtolower($request->header->getClientOriginalExtension());
                $image_full_header = $header_name . '.' . $extheader;
                $header_url = $path . $image_full_header;
                $success2 = $request->header->move($path, $image_full_header);
            }
            $user = $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->file('header') && $request->file('profile')) {
                $profiledoctor = $profiledoctor->update([
                    'birthday' => $request->birthday,
                    'facebook' => $request->facebook,
                    'gender_id' => $request->gender_id,
                    'header' => $header_url,
                    'profile' => $image_url,
                    'insgram' => $request->insgram,
                    'linkediin' => $request->linkediin,
                    'location_id' => $request->location_id,
                    'price' => $request->price,
                    'phone' => $request->phone,
                    'twitter' => $request->twitter,
                    'text' => $request->text,
                ]);
            } elseif ($request->file('profile')) {
                $profiledoctor = $profiledoctor->update([
                    'birthday' => $request->birthday,
                    'facebook' => $request->facebook,
                    'gender_id' => $request->gender_id,
                    'profile' => $image_url,
                    'insgram' => $request->insgram,
                    'linkediin' => $request->linkediin,
                    'location_id' => $request->location_id,
                    'price' => $request->price,
                    'phone' => $request->phone,
                    'twitter' => $request->twitter,
                    'text' => $request->text,
                ]);
            } elseif ($request->file('header')) {
                $profiledoctor = $profiledoctor->update([
                    'birthday' => $request->birthday,
                    'facebook' => $request->facebook,
                    'gender_id' => $request->gender_id,
                    'header' => $header_url,
                    'insgram' => $request->insgram,
                    'linkediin' => $request->linkediin,
                    'location_id' => $request->location_id,
                    'price' => $request->price,
                    'phone' => $request->phone,
                    'twitter' => $request->twitter,
                    'text' => $request->text,
                ]);
            } else {
                $profiledoctor = $profiledoctor->update([
                    'birthday' => $request->birthday,
                    'facebook' => $request->facebook,
                    'gender_id' => $request->gender_id,
                    'insgram' => $request->insgram,
                    'linkediin' => $request->linkediin,
                    'location_id' => $request->location_id,
                    'price' => $request->price,
                    'phone' => $request->phone,
                    'twitter' => $request->twitter,
                    'text' => $request->text,
                ]);
            }
            if ($profiledoctor || $user) {
                return response()->json(['status' => true, 'success' => 'success edit'], 200);
            } else {
                return response()->json(['status' => false, 'success' => 'retry edit filed edit'], 422);
            }
        } else {

            return response()->json(['status' => true, 'success' => 'user not found'], 422);
        }
    }

    public function addnewOfferview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        return view('doctor.pages.addOffer', compact('doctor'));
    }

    public function sericeview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);

        return view('doctor.pages.addService', compact('doctor'));
    }

    public function addOfferdb(offer $offer)
    {
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $service = \App\Models\offer::create([
            'name_ar' => $offer->name_ar,
            'name_en' => $offer->name_en,
            'description_ar' => $offer->description_ar,
            'description_en' => $offer->description_en,
            'profiledoctors_id' => $profiledoctor->id,
            'price' => $offer->price,
        ]);
        return response()->json([
            'status' => true,
            'success' => 'success edit',
        ], 200);
    }

    public function sericedb(service $service)
    {
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $service = \App\Models\service::create([
            'name_ar' => $service->name_ar,
            'name_en' => $service->name_en,
            'description_ar' => $service->description_ar,
            'description_en' => $service->description_en,
            'profiledoctors_id' => $profiledoctor->id,
            'price' => $service->price,
        ]);
        return response()->json([
            'status' => true,
            'success' => 'success edit',
        ], 200);
    }

    public function educationview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);

        return view('doctor.pages.education', compact('doctor'));
    }

    public function educationdb(education $educations)
    {
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $education = \App\Models\education::where('name_ar', $educations->name_ar)->where('profiledoctors_id', $profiledoctor->id)->exists();

        if ($education) {
            return response()->json([
                'status' => true,
                'success' => 'this is exists',
            ], 200);
        } else {
            $service = \App\Models\education::create([
                'name_ar' => $educations->name_ar,
                'name_en' => $educations->name_en,
                'profiledoctors_id' => $profiledoctor->id,
                'end_date' => $educations->end_date,
                'presente' => $educations->presente,
            ]);
            if ($service) {
                return response()->json([
                    'status' => true,
                    'success' => 'success add education',
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'success' => 'retry it ',
                ], 200);
            }
        }

    }

    public function titleview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $title = titles::get();
        $specDoc = \App\Models\titlesdoctor::where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.title', compact('doctor', 'title', 'specDoc'));
    }

    public function titledb(titlesdoctor $titlesdoctor)
    {
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $specDoc = \App\Models\titlesdoctor::where('profiledoctors_id', $profiledoctor->id)->delete();
        foreach ($titlesdoctor->title_id as $title_id) {
            $service = \App\Models\titlesdoctor::create([
                'title_id' => $title_id,
                'profiledoctors_id' => $profiledoctor->id,
            ]);

        }
        if ($service) {
            return response()->json([
                'status' => true,
                'success' => 'success add education',
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'success' => 'retry add',
            ], 200);

        }

    }

    public function experienceview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        return view('doctor.pages.experience', compact('doctor'));

    }

    public function experiencedb(experience $experience)
    {
        $count = count($experience->name_ar);
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();

        for ($i = 0; $i < $count; $i++) {
            $experien = \App\Models\experience::where("name_en", $experience->name_en[$i])->where('profiledoctors_id', $profiledoctor->id)->exists();
            if ($experien) {
                return response()->json([
                    'status' => true,
                    'success' => 'it is exsisi',
                ], 200);
            } else {
                $x = \App\Models\experience::create([
                    'name_ar' => $experience->name_ar[$i],
                    'start_date' => $experience->start_date[$i],
                    'name_en' => $experience->name_en[$i],
                    'end_date' => $experience->end_date[$i],
                    'profiledoctors_id' => $profiledoctor->id,
                    'description_ar' => $experience->description_ar[$i],
                    'description_en' => $experience->description_en[$i],
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'success' => 'all add',
        ], 200);
    }

    public function tagview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        return view('doctor.pages.tag', compact('doctor'));

    }

    public function postview()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $tags = tags::get();
        return view('doctor.pages.post', compact('doctor', 'tags'));

    }

    public function tagdb(\App\Http\Requests\tags $tags)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $tag = tags::where('name_en', $tags->name_en)->exists();
        if ($tag) {
            return response()->json([
                'status' => true,
                'success' => 'it is exsisi',
            ], 200);
        } else {
            $tagscreate = tags::create([
                'name_ar' => $tags->name_ar,
                'name_en' => $tags->name_en,
            ]);

            return response()->json([
                'status' => true,
                'success' => 'all add',
            ], 200);
        }

    }

    public function postdb(posts $post)
    {
        $path = 'upload/image/';
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();

        if ($post->file('photo')) {
            $header_name = 'post_' . time();
            $extheader = strtolower($post->photo->getClientOriginalExtension());
            $image_full_header = $header_name . '.' . $extheader;
            $header_url = $path . $image_full_header;
            $success2 = $post->photo->move($path, $image_full_header);
        }
        $storePost = \App\Models\posts::create([
            'tittle_ar' => $post->tittle_ar,
            'title_en' => $post->title_en,
            'description_ar' => $post->description_ar,
            'description_en' => $post->description_en,
            'profiledoctors_id' => $profiledoctor->id,
            'photo' => $header_url,
            'create_at' => date("Y-m-d")
        ]);
        if ($storePost) {
            foreach ($post->tag as $pos) {
                $tagsPosts = tagsPosts::create([
                    'tag_id' => $pos,
                    'post_id' => $storePost->id
                ]);
            }
        }
        if ($storePost && $storePost) {
            return response()->json([
                'status' => true,
                'success' => 'post added',
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'success' => 'please retry',
            ], 200);

        }

    }

    public function AllPosts()
    {

        $doctor = User::with(
            ['doctorprofile.gender', 'doctorprofile.location', 'doctorprofile.specialtiesdoctor', 'doctorprofile.service',
                'doctorprofile.education'
                , 'doctorprofile.offer', 'doctorprofile.titlesdoctor', 'doctorprofile.experience', 'doctorprofile.posts.postTags']
        )->find(Auth::user()->id);
        return view('doctor.pages.AllPosts', compact('doctor'));
    }

    public function getSinglePost($id)
    {

        $doctor = User::with(
            ['doctorprofile.gender',
                'likesUserPost',
                'doctorprofile.location',
                'doctorprofile.specialtiesdoctor',
                'doctorprofile.service',
                'doctorprofile.education',
                'doctorprofile.offer',
                'doctorprofile.titlesdoctor',
                'doctorprofile.experience',
                'doctorprofile.posts' => function ($q) use ($id) {
                    $q->where('id', $id);
                    $q->withAvg('postrate', 'rate');
                    $q->withSum('postrate', 'rate');
                    $q->withCount('postrate');
                    $q->withCount('likesPost');

                },
                'doctorprofile.posts.postTags',
                'doctorprofile.posts.postrate',
                'doctorprofile.posts.likesPost'
                , 'doctorprofile.posts.user.doctorprofile'
            ]
        )->find(Auth::user()->id);

        $viewr = ++$doctor->doctorprofile->posts[0]->viewer;
        $post = \App\Models\posts::where('id', $id)->first();
        $addView = $post->update([
            'viewer' => $viewr
        ]);
        //return $doctor;
        return view('doctor.pages.singlePost', compact('doctor'));

    }

    public function ratingPost(Request $request)
    {
        $doctor = User::find(Auth::user()->id);
        $allRate = $rate = ratingPost::where('post_id', $request->post)->where('user_id', $doctor->id)->first();

        if ($allRate) {
            $uprate = $allRate->update([
                'rate' => $request->rate
            ]);
        } else {
            $rate = ratingPost::create([
                'user_id' => $doctor->id,
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

    public function createOrRemoveLike(Request $request)
    {
        $doctor = User::find(Auth::user()->id);
        $postHasLike = likepost::where('user_id', $doctor->id)->where('post_id', $request->post)->first();
        if ($postHasLike) {
            $postHasLike = $postHasLike->delete();
        } else {
            $likepost = likepost::create([
                'user_id' => $doctor->id
                , 'post_id' => $request->post
            ]);
        }

        return response()->json([
            'status' => true,
            'success' => 'please retry',
        ], 200);

    }

    public function viewTableOffers()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $offers = \App\Models\offer::where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.table.tableOffer', compact('doctor', 'offers'));

    }

    public function viewTableEducation()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $education = \App\Models\education::where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.table.tableEducation', compact('doctor', 'education'));

    }

    public function viewTableService()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $services = \App\Models\service::where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.table.tableService', compact('doctor', 'services'));

    }

    public function deleteOffer(Request $id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $offers = \App\Models\offer::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id->id)->first();
        $delete = $offers->delete();

    }

    public function deleteEducation(Request $id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $education = \App\Models\education::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id->id)->first();
        $delete = $education->delete();

    }

    public function deleteService(Request $id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $service = \App\Models\service::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id->id)->first();
        $services = $service->delete();
    }

    public function editService($id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $service = \App\Models\service::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id)->first();
        return view('doctor.pages.editService', compact('doctor', 'service'));
    }

    public function updateService(service $service)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $services = \App\Models\service::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $service->id)->first();
        $serviceUpdate = $services->update([
            'name_ar' => $service->name_ar,
            'name_en' => $service->name_en,
            'description_ar' => $service->description_ar,
            'description_en' => $service->description_en,
            'price' => $service->price,
        ]);
        return response()->json([
            'status' => true,
            'success' => 'success edit service',
        ], 200);

    }

    public function editffer($id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $offers = \App\Models\offer::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id)->first();
        return view('doctor.pages.editOffer', compact('doctor', 'offers'));

    }

    public function editEducation($id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $education = \App\Models\education::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id)->first();
        return view('doctor.pages.editEducation', compact('doctor', 'education'));

    }

    public function updateOffer(offer $offer)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $offers = \App\Models\offer::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $offer->id)->first();
        $offers = $offers->update([
            'name_ar' => $offer->name_ar,
            'name_en' => $offer->name_en,
            'description_ar' => $offer->description_ar,
            'description_en' => $offer->description_en,
            'price' => $offer->price,
        ]);
        return response()->json([
            'status' => true,
            'success' => 'success edit $offers',
        ], 200);

    }

    public function updateEducation(education $education)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $offers = \App\Models\education::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $education->id)->first();
        $offers = $offers->update([

            'name_ar' => $education->name_ar,
            'name_en' => $education->name_en,
            'end_date' => $education->end_date,
            'presente' => $education->presente,
        ]);
        return response()->json([
            'status' => true,
            'success' => 'success edit $offers',
        ], 200);
    }

    public function deleteExperience(Request $id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $experience = \App\Models\experience::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id->id)->first();
        $experiences = $experience->delete();

    }

    public function viewTableExperience()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $experiences = \App\Models\experience::where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.table.tableExperience', compact('doctor', 'experiences'));

    }

    public function editExperience($id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $experience = \App\Models\experience::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id)->first();
        return view('doctor.pages.editExperience', compact('doctor', 'experience'));

    }

    public function updateExperience(experienceEdit $request)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $experience = \App\Models\experience::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $request->id)->first();

        $experiences = $experience->update([
            'name_ar' => $request->name_ar,
            'start_date' => $request->start_date,
            'name_en' => $request->name_en,
            'end_date' => $request->end_date,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);

        return response()->json([
            'status' => true,
            'success' => 'success edit service',
        ], 200);

    }

    public function viewTablePosts()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $posts = \App\Models\posts::with(['postTags'])->where('profiledoctors_id', $doctor->doctorprofile->id)->get();
        return view('doctor.pages.table.tablePosts', compact('doctor', 'posts'));

    }

    public function deletePost(Request $id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $post = \App\Models\posts::where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id->id)->first();
        $experiences = $post->delete();
        File::delete(public_path($post->photo));
        $specDoc = \App\Models\tagsPosts::where('post_id', $post->id)->delete();
    }

    public function editPost($id)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $post = \App\Models\posts::with(['postTags'])->where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $id)->first();
        $tags = tags::get();
        return view('doctor.pages.editPost', compact('doctor', 'post', 'tags'));

    }

    public function updatePost(editPost $post)
    {
        $path = 'upload/image/';
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        $profiledoctor = \App\Models\profiledoctor::where('user_id', Auth::user()->id)->first();
        $posts = \App\Models\posts::with(['postTags'])->where('profiledoctors_id', $doctor->doctorprofile->id)->where('id', $post->id)->first();
        $tag = tagsPosts::where('post_id', $posts->id)->delete();

        if ($post->file('photo')) {

            File::delete(public_path($posts->photo));
            $header_name = 'post_' . time();
            $extheader = strtolower($post->photo->getClientOriginalExtension());
            $image_full_header = $header_name . '.' . $extheader;
            $header_url = $path . $image_full_header;
            $success2 = $post->photo->move($path, $image_full_header);
            $storePost = $posts->update([
                'tittle_ar' => $post->tittle_ar,
                'title_en' => $post->title_en,
                'description_ar' => $post->description_ar,
                'description_en' => $post->description_en,
                'photo' => $header_url,
            ]);

            foreach ($post->tag as $pos) {
                $tagsPosts = tagsPosts::create([
                    'tag_id' => $pos,
                    'post_id' => $post->id
                ]);
            }
            return response()->json([
                'status' => true,
                'success' => 'success edit service',
            ], 200);
        } else {
            $storePost = $posts->update([
                'tittle_ar' => $post->tittle_ar,
                'title_en' => $post->title_en,
                'description_ar' => $post->description_ar,
                'description_en' => $post->description_en,
            ]);

            foreach ($post->tag as $pos) {
                $tagsPosts = tagsPosts::create([
                    'tag_id' => $pos,
                    'post_id' => $post->id
                ]);
            }
            return response()->json([
                'status' => true,
                'success' => 'success edit service',
            ], 200);
        }
    }

    public function addClinic()
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);
        return view('doctor.pages.add.addClinic', compact('doctor'));
    }

    public function createClinic(clinic $clinic)
    {
        $doctor = User::with(['doctorprofile.gender', 'doctorprofile.location'])->find(Auth::user()->id);

        $path = 'upload/image/';
        if ($clinic->file('image')) {
            $clinicStore = \App\Models\clinic::create([
                'tittle_ar' => $clinic->tittle_ar,
                'tittle_en' => $clinic->tittle_en,
                'lat' => $clinic->lat,
                'lang' => $clinic->lng,
                'description_en' => $clinic->description_en,
                'description_ar' => $clinic->description_ar,
                'address' => $clinic->address,
                'phone' => $clinic->phone,
                'profiledoctors_id' =>$doctor->doctorprofile->id
        ]);
            $i=0;
            foreach ($clinic->image as $image) {
                ++$i;
                $image = $this->UploadImage($path, $image, 'clinic'.$i);
                $img=clinicImage::create([
                    'clinic_id'=>$clinicStore->id,
                    'image'=>$image
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'success' => 'success edit service',
        ], 200);
    }

    public function tableClinic(){
        $doctor = User::with(['doctorprofile.clinics.ClinicImage'])->find(Auth::user()->id);

        return view('doctor.pages.table.tableClinic',compact('doctor'));
    }

}
