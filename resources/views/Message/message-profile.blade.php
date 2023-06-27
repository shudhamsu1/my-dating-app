<x-app>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <p class="text-4xl font-bold p-4 text-center">Start a new conversation</p>
            <hr>
            <form action="/messages/{{$user->id}}" method="post">
                @csrf
                <div class="form-group m-3">
                    <label for="recipient" class="text-2xl p-2">Recipient</label>
                    <input type="text" name="recipient" id="recipient" class="form-control" value="{{$user->first_name}} {{$user->last_name}} "  disabled>
                </div>
                <div class="form-group m-3">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary m-3 text-black">Send</button>
            </form>
        </div>
    </div>

</x-app>
