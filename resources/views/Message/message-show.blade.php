<x-app>

    <div class="container-fluid"></div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <p class="text-4xl font-bold  m-4">Conversations</p>

            <ul class="list-unstyled">
                @foreach($messages as $message)
                    <li>
                        <a href="{{ route('messages.show', $message->receiver->first_name) }}" >
                            <p class="text-2xl font-bold">{{ $message->receiver->name }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </di>
        <div class="col-md-12">
            @if($message->receiver_id == auth()->user()->id)
                <p class="font-bold">{{ $message->sender->first_name }}</p>
            @endif
            @foreach($messages as $message)

                <hr>
                <div class="messages">
                    <div class="message">
                        <p class="meta text-2xl font-bold">{{ $message->sender->first_name }} {{ $message->sender->last_name }} <span>{{ $message->created_at->now() }}</span></p>
                        <p>{{ $message->message }}</p>
                    </div>
                    @endforeach

                </div>
                {{$message->receiver_id}}
                {{$message->sender_id}}
                {{auth()->user()->id}}

                @if($message->receiver_id == auth()->user()->id)
                        <form action="/messages/{{$message->sender_id}}" method="post">
                            @else
                                <form action="/messages/{{$message->receiver_id}}" method="post">
                                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="message" class="text-muted mb-1"><small>Message</small></label>
                            <textarea name="message" class="form-control" id="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif






        </div>

    </div>
    </div>


</x-app>
