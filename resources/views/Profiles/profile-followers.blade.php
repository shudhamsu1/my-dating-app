<x-profileHead :firstName="$firstName" :lastName="$lastName"  :user="$user" :currentlyFollowing="$currentlyFollowing" :currentFollowers="$currentFollowers">

    <div class="p-3 m-4 bg-white">
            @foreach($followers as $follow)
                <li class="list-group-item">
                    <a href="/profile/{{$follow->userDoingTheFollowing->id}}" class="d-flex align-items-center text-decoration-none">
                        <img class="rounded-circle img-fluid mr-3 " src="{{$follow->userDoingTheFollowing->profileImage()}}" alt="no image" width="60" height="60">
                        <span>{{$follow->userDoingTheFollowing->first_name}} {{$follow->userDoingTheFollowing->last_name}}</span>
                    </a>
                </li>
            @endforeach

    </div>

    </div>

</x-profileHead>
