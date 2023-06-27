<x-app>
    <div class="container pt-2">
    <div class="row">
        <div class="col-2 pt-4 ">
            <img src="{{$user->profileImage()}}"
                alt="wrapkit" class="rounded-circle img-fluid w-100"/>
        </div>

        <div class="col-9 pt-5 ">
            <div class="d-flex justify-content-between align-items-baseline">

                <h1 class="text-5xl font-bold">{{$user->first_name}} <span>{{$user->last_name}}</span></h1>
                    {{--                {{dd($user)}}--}}
                    {{--                if the user is not currentfollowing and the user is not the loggin in user the show follow button--}}
                @if(!$currentlyFollowing AND auth()->user()->id !== $user->id)
                    <form class="ml-2 d-inline" action="/create-follow/{{$user->id}}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                        <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                    </form>
                @endif
                @if($currentlyFollowing)
                <form class="ml-2 d-inline" action="/remove-follow/{{$user->id}}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-sm">Unfollow <i class="fas fa-user-plus"></i></button>
                    <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                </form>
                @endif



                    {{--@if($currentlyFollowing)
                        <form class="ml-2 d-inline" action="/remove-follow/{{$user}}" method="POST">
                            @csrf

                            <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button>
                        </form>--}}

                        {{--                    <form class="ml-2 d-inline" action="#" method="POST">--}}
                        {{--                        @csrf--}}

                        {{--                        <button class="btn btn-primary btn-sm">Message <i class="fas fa-user-plus"></i></button>--}}
                        {{--                    </form>--}}

            </div>
            <div>
                @if($currentlyFollowing AND $currentFollowers)
                    <button class="btn btn-secondary"><a href="/profile/{{$user->id}}/message">Message</a></button>
                @endif
            </div>
            <div class="d-flex pt-2">
            <div>
                @if($user->id == Auth::user()->id)
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signupModal" style="background-color: dimgray">Edit Avatar</button>
                @endif
            </div>
                <div class="ps-3">
                    @if($user->id == Auth::user()->id)
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#profileModal" style="background-color: dimgray">Edit Profile</button>
                    @endif
                </div>
                <div class="ps-3">
                    @if($user->id == Auth::user()->id)
                        <button class="btn btn-secondary"> <a href="/p/create">Add  New Post</a></button>
                    @endif
                </div>

            </div>


               {{-- <div class="  d-flex pt-2">
                    <div class=" pe-4"><button class="btn  btn-outline-dark text-sm mx-1 font-bold bg-gary-300 hover-gray-500"><span><strong>{{$user->posts->count()}}</strong></span><a href="/profile/{{$user->id}}">  Post</a></button></div>
                    <div class="pe-4"><button class="btn btn-outline-dark text-sm mx-1 font-bold bg-gary-300 hover-gray-500"><span><strong>15</strong></span> <a href="/profile/{{$user->id}}/follower">  followers</a></button></div>
                    <div class="pe-4"><button class="btn btn-outline-dark text-sm mx-1 font-bold bg-gary-300 hover-gray-500"><span><strong>128</strong></span> <a href="/profile/{{$user->id}}/following">  following</a></button></div>

                </div>--}}

            <div class="pt-2">
                <p class="text-xl font-bold">Bio</p>
            <p class="px-2 text-back">{{$user->bio}}</p>
            </div>

            <div class="profile-nav nav nav-tabs pt-2 mb-4">
                <a href="/profile/{{$user->id}}" class="profile-nav-link text-xl nav-item text-black nav-link {{ Request::segment(3) == "" ? "active" : '' }} "><span><strong>{{$user->posts->count()}}</strong></span> Posts:</a>
                <a href="/profile/{{$user->id}}/follower" class="profile-nav-link text-xl text-black nav-item nav-link {{Request::segment(3) == "follower" ? "active": ""}} "> <span><strong>{{$user->followers->count()}}</strong></span> Followers</a>
                <a href="/profile/{{$user->id}}/following" class="profile-nav-link text-xl text-black nav-item nav-link {{ Request::segment(3) == "following" ? "active" : "" }} "><span><strong>{{$user->userFollowing->count()}}</strong></span> Following</a>
            </div>

        </div>
        {{--Profile Picture--}}

        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue-100">
                    <h5 class="modal-title" id="signupModalLabel">Upload Profile Picture</h5>
                    <button type="button" class=    "text-gray-400 text-3xl font-bold hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body bg-blue-100">
                    <form method="POST" action="/i" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label">Update Profile Picture</label>

                            <input type="file" class="form-control-file" id="image" name="profile_picture">

                            @if ($errors->has('profile_picture'))
                                <strong>{{ $errors->first('profile_picture') }}</strong>
                            @endif
                        </div>
                    <div class="pt-2">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{-- Profile Edit--}}
        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue-100">
                        <h5 class="modal-title" id="signupModalLabel">Edit Your Profile Details</h5>
                        <button type="button" class=    "text-gray-400 text-3xl font-bold hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-blue-100">
                        <form class="mx-1 mx-md-4" method="POST" action="/profile/{{$user->id}}" enctype="multipart/form-data"  >
                            @csrf

                            <div class="d-flex flex-row align-items-center mb-4">

                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" name="first_name" value="{{old('first_name')?? $user->first_name}}" class="form-control" />
                                    <label class="form-label" for="form3Example1c">First Name</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" value="{{old('last_name')?? $user->last_name}}" name="last_name" class="form-control" />
                                    <label class="form-label" for="form3Example1c">Last Name</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <textarea id="form3Example1c" name="bio" value="{{old('bio')?? $user->bio}}"  cols="5" rows="5" class="form-control"></textarea>
                                    <label class="form-label" for="form3Example4c">Biography</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center  mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="ar-select" id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <label for="address"   class="form-label">Address</label>
                                    <input type="text" value="{{old('address')?? $user->address}}" name="address" class="form-control" id="address" rows="3" placeholder="Enter address"></input>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input name="date_of_birth" type="date" class="form-control"  value="{{old('date_of_birth')?? $user->date_of_birth}}" id="dob" pattern="\d{4}-\d{2}-\d{2}" required>

                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <button type="submit" class="btn btn-info">Save Changes</button>
                                <button class="btn  btn-lg"><a href="/profile/{{$user->id}}">Cancel</a> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container pt-1">
        {{$slot}}
    </div>
</x-app>








