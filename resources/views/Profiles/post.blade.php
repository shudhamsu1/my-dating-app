<x-profileHead :firstName="$firstName" :lastName="$lastName" :user="$user" :currentFollowers="$currentFollowers" :currentlyFollowing="$currentlyFollowing">
    <div class="row pt-5 bg-white m-4">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">

                <img src="/storage/{{$post->image}}"alt="wrapkit" class="w-100">
                <p class="pt-2">{{$post->caption}}</p>

            </div>
        @endforeach
    </div>
</x-profileHead>
