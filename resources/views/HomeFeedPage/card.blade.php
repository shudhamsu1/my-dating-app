<x-homefeed :user="$user" :cards="$cards">

    <!-- Card section -->


    <div class="container">
        <div class="row">
            @foreach($cards as $card)
                @if($card->id !== Auth::user()->id)
                    <div class="col-md-3 mb-3">
                        <div class="card" style="width: 18rem;">

                            <img src="{{$card->profileImage()}}" class="card-img-top" alt="Doctor 1">
                            <div class="card-body">
                                <h5 class="card-title">{{$card->first_name}} {{$card->last_name}}</h5>
                                <p class="card-text">{{$card->gender}}</p>
                                    <span>   <a href="/profile/{{$card->id}}" class="btn btn-primary ml-9 text-align-center">View Profile</a></span>

                              {{-- @if(auth()->user()->id ==$currentlyFollowing->user_id)
                                    <form class="ml-2 d-inline" action="/create-follow/{{$card->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                                        <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                                    </form>
                                @endif
                                @if($currentlyFollowing)
                                    <form class="ml-2 d-inline" action="/remove-follow/{{$card->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Unfollow <i class="fas fa-user-plus"></i></button>
                                        <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                                    </form>
                                @endif
                            </div>
                            <div>
                                @if($currentlyFollowing AND $currentFollowers)
                                    <button class="btn btn-secondary"><a href="/profile/{{$user->id}}/message">Message</a></button>
                                @endif
                            </div>--}}
                        </div>
                        </div>
                    </div>

                @endif
            @endforeach
        </div>
        <div class="mt-6 p-4">
            {{$cards->links()}}
        </div>

    </div>
</x-homefeed>


























