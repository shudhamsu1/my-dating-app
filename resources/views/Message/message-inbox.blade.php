<x-app>
    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width: 60rem;">
                    <div class="card-header">{{ __('Inbox') }}</div>
                    @foreach ($messages as $message)

                        <div class="card">
                            <div class="card-body">
                                <a href="/profile/{{$message->sender->id}}" class="d-flex align-items-center ">
                                    <img class="rounded-circle img-fluid" src="{{$message->sender->profileImage()}}" class="card-img-top" alt="" width="60" height="60">
                                    {{ $message->sender->first_name }}:
                                </a>
                                <p class="card-text p-4 m-2 border">{{$message->message}}</p>
                                <a href="{{ route('messages.show', $message->sender->id) }}" class="btn btn-primary">Reply</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</x-app>
