<x-profileHead :firstName="$firstName" :lastName="$lastName"  :user="$user" :currentlyFollowing="$currentlyFollowing" :currentFollowers="$currentFollowers">
        <div class="p-3 m-4 bg-white">
            @foreach($followings as $following)
                <li class="list-group-item">
                    <a href="/profile/{{$following->userBeingFollowed->id}}" class="d-flex align-items-center text-decoration-none">
                        <img class="rounded-circle img-fluid mr-3 " src="{{$following->userBeingFollowed->profileImage()}}" alt="no image" width="60" height="60">
                        <span>{{$following->userBeingFollowed->first_name}} {{$following->userBeingFollowed->last_name}}</span>
                    </a>
                </li>
            @endforeach

        </div>

</x-profileHead>

