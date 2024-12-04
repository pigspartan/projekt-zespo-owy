<x-layout>
    <div class="ml-60 mr-60 min-w-min">
        <h1 class="text-center text-3xl p-4 bg-sky-700">{{$item->title}}</h1>
        <div class="flex flex-wrap">
            <img class="max-w-80" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-grow">
                <p class="p-4 text-xl">Opis: {{$item->content}}</p>
                <a href="{{route('userListings',['id' => $item->user->id])}}" class="pl-4">Sprzedający: {{$item->user->name}}</a>
                <div class="p-2 flex justify-center">
                    <button class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded" id='kup'>Zakup</button>
                    <button class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded">Wyślij wiadomość</button>


                    {{-- bool canFlag: true->może flagować; false->nie może flagować; --}}
                    <form action="{{ route('listing.flag', $item->id) }}" method="POST">
                        @csrf
                        <label for="reason">Reason for flagging:</label>
                        <textarea name="reason" id="reason" required></textarea>
                        <button type="submit" class="btn btn-danger">Flag Listing</button>
                    </form>



                    {{-- <button onclick="location.href='{{route('listing.flag',['id' => $item->id])}}'" class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded" id='flag'>Oflaguj</button> --}}
                </div>
                <p class="pt-2 text-right text-sm">Ogłoszenie utworzono: {{$item->created_at}}</p>
                <p class="text-right text-sm">Ostatnia aktualizacja: {{$item->updated_at}}</p>

                @role('Admin')


                @if($item->flaggedByUsers->isEmpty())
        <p>No flags for this listing.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Reason</th>
                    <th>Flagged At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item->flaggedByUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->pivot->reason }}</td>
                        <td>{{ $user->pivot->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endrole

            </div>
        </div>
    </div>



    <script>
        document.getElementById('kup').addEventListener('click', function() {
            window.location.href = "{{ route('paypal.createPayment') }}?Id=" + {{$item->id}};
        });
    </script>
</x-layout>
