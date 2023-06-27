<x-homefeed :users="$users">

    <!-- Card section -->



    <div class="container">
        <div class="row">
            @foreach($users as $user)
                @if($user->id !== Auth::user()->id)
                    <div class="col-md-3 mb-3">
                        <div class="card" style="width: 18rem;">

                            <img src="{{$user->profileImage()}}" class="card-img-top" alt="Doctor 1"
                                 width="300"
                                 height="200">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
                                <p class="card-text">{{$user->gender}}</p>
                                <a href="/profile/{{$user->id}}" class="btn btn-primary mr-2">View Profile</a>
                                {{--@if(!$currentlyFollowing AND Auth::user()->id !== $user->id)
                                    <form class="ml-2 d-inline" action="/create-follow/{{$user->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                                        <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                                    </form>
                                @endif--}}
                               {{-- @if(dd($currentlyFollowing))
                                    <form class="ml-2 d-inline" action="/remove-follow/{{$user->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Unfollow <i class="fas fa-user-plus"></i></button>
                                        <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                                    </form>
                                @endif--}}
                            </div>
                        </div>
                    </div>

                @endif
            @endforeach
        </div>
    </div>
</x-homefeed>



























