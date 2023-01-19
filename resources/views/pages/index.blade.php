@extends('layouts.default')
@section('content')
<div class="m-8 p-4 bg-white d-flex align-items-center">
    <div class="flex-fill">
        <h1 class="text-3xl">Hi, ich bin  <span style="color:#f58220;">BRO</span></h1>
        <b><p class="pt-2">Ich kümmere mich um die belegung der Meeting-Räume.</p></b>
    </div>
    <div class="flex-fill">
        <h1>
        <span id="dateAndTime"></span>
        <script>
        setInterval(function() {
        var dateAndTime = document.getElementById('dateAndTime');
        var currentTime = new Date();
        dateAndTime.innerHTML = currentTime.toLocaleDateString() + ' - ' +currentTime.toLocaleTimeString();
        }, 100);
        </script>
        </h1>
    </div>
</div>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="mx-8">
        {{-- Fehllermeldung anzeigen, wenn es Überschneidungen gab --}}
        @if (Session::get('error') === 'invalid')
        <div class="alert alert-danger" role="alert">
            Der Startzeitpunkt darf nicht vor dem Endzeitpunkt liegen
        </div>
        @elseif (Session::get('error') === 'overlap')
        <div class="alert alert-danger" role="alert">
            Der Raum Konnte nicht gebucht werden, da es zeitliche Überschneidungen gab
        </div>
        @endif
        <div class="d-flex gap-4 justify-content-between mb-8">
            @foreach ($rooms as $room)
            {{-- Eine Spalte pro raum --}}
            <section class="p-4 rounded bg-white flex-fill">
                <h2><span class="text-capitalize">{{$room->name}}</span></h2>
                <div class="mb-8">
                    <form
                        action="{{route('room.book', $room->id)}}"
                        method="post"
                        class="d-flex flex-column gap-2"
                        >
                        <div class="d-flex gap-4 justify-content-between">
                            <div class="form-group">
                                <label for="datum">Datum</label>
                                <input class="form-control" type="date" name="datum" id="datum" required>
                            </div>
                            <div class="form-group flex-fill">
                                <label for="start">Von</label>
                                <input class="form-control" type="time" name="start" id="start" required>
                            </div>
                            <div class="form-group flex-fill">
                                <label for="ende">Bis</label>
                                <input class="form-control" type="time" name="ende" id="ende" required>
                            </div>
                        </div>
                        <div class="d-flex gap-4 justify-content-between align-items-end">
                            <div class="form-group flex-fill">
                                <label for="notiz">Name</label>
                                <input class="form-control" type="text" name="notiz" id="notiz" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Buchen</button>
                            </div>
                            <input type="hidden" name="raum">
                        </div>
                    </form>
                </div>
                @if ($room->buchungen->count() > 0)
                {{-- Buchungen nur anzeigen, wenn es welche gibt --}}
                <h3>Bereits gebucht:</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Von</th>
                            <th>Bis</th>
                            <th>Gebucht von</th>
                            <th>Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($room->buchungen as $buchung)
                        <tr>
                            <th>{{ date('d.m.y', strtotime($buchung->datum)) }}</th>
                            <th>{{ date('g:i', strtotime($buchung->start)) }}</th>
                            <th>{{ date('g:i', strtotime($buchung->ende)) }}</th>
                            <th>{{ $buchung->notiz }}</th>
                            <th>
                                <a href="/buchungen">
                                    <form action="{{route('buchung.delete', $buchung->id)}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" value="{{$buchung->id}}">&times;</button>
                                    </form>
                                </a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h3>Noch keine Buchungen</h3>
                @endif
            </section>
            @endforeach
        </div>
        <section class="p-4 rounded bg-white flex-fill">
            <h2>Karte</h2>
            <div class="d-flex justify-content-center"><img src="/Grundrisse.png"></div>
        </section>
    </div>
</main>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted"> </span>
        <div class="hidden sm:block sm:ml-6 row">
            <div class="flex space-x-4">
                <a target="_blank" href="impressum"
                class="text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Impressum</a>
            </div>
        </div>
    </div>
</footer>
@endsection
