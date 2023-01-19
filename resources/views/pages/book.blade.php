@extends('layouts.default')
@section('content')
<div class="mx-8 my-8 px-7 py-8 bg-white">
    <h1 class="text-3xl">
    <b> Hi, ich bin  <font style="color:#f58220;">BRO</font></b>
    </h1>
    <b><p class="mt-4">Ich kümmere mich um die belegung der Meeting-Räume.</p></b>
</div>
<!-- Begin page content -->
<main class="m-8">
    <div class="mb-8">
        <form action="{{route('book.room')}}" method="post" class="d-flex flex-row justify-content-between align-items-end">
            <div class="form-group">
                <label for="start">Von</label>
                <input class="form-control" type="time" name="start" id="start" required>
            </div>
            <div class="form-group">
                <label for="ende">Bis</label>
                <input class="form-control" type="time" name="ende" id="ende" required>
            </div>
            <div class="form-group">
                <label for="datum">Datum</label>
                <input class="form-control" type="date" name="datum" id="datum" required>
            </div>
            <div class="form-group">
                <label for="notiz">Name</label>
                <input class="form-control" type="text" name="notiz" id="notiz" required>
            </div>
            <div class="form-group">
                <button type="submit"  class="btn btn-primary">Buchen</button>
            </div>
            <input type="hidden" name="raum" value="{{$room->id}}">
        </form>
    </div>
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
