<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;
use \App\Models\Buchungen;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    /**
     * Zeigt die Übersicht mit allen Räumen und Buchungen an
     */
    public function index()
    {
        # Die Räume werden zusammen mit ggf. vorhandenen Buchungen aus der Datenbank geladen
        $rooms = Room::with('buchungen')->get();

        # Die Übersicht wird mit den Räumen von oben ausgegeben
        return view('pages.index', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Verarbeitet die Buchungsanfragen
     * @param  Request $request Enthält die Buchungsdetails
     * @param  Room    $room    Der Raum, der gebucht werden soll (übergeben via Url Parameter)
     */
    public function bookRoom(Request $request, Room $room)
    {
        # Start und Ende werden von String zu Carbon-Objekt umgewandelt,
        # um Vergleiche  zu ermöglichen
        $start = new Carbon($request->start);
        $ende = new Carbon($request->ende);

        # Es wird sichergestellt, dass das Ende nicht nach dem Start ist
        if ($start->isAfter($ende) || $start->eq($ende)) {
            # Fehler via Session-Variable an die Ansicht weitergeben
            Session::flash('error', 'invalid');
            # Zurück zur vorherigen Seite
            return redirect()->back();
        }

        # Bei allen Buchungen prüfen, ob die Zeiten aus der Anfrage schon belegt sind
        foreach ($room->buchungen as $buchung) {

            # Zeiten aus den Buchungen von String in Carbon-Objekt umwandeln für den Vergleich
            $buchungStart = new Carbon($buchung->start);
            $buchungEnde = new Carbon($buchung->ende);
            $buchungDatum = new Carbon($buchung->datum);

            # Prüfen, ob es Überlappungen gibt
            if (
                $buchungStart->isAfter($start) && $buchungStart->isBefore($ende) ||
                $buchungStart->eq($start) && $buchungStart->eq($ende) ||
                $buchungEnde->isAfter($start) && $buchungEnde->isBefore($ende) ||
                $buchungEnde->eq($start) && $buchungEnde->eq($ende)
            ) {
                # Bei Überlappungen Fehler in die Session legen
                Session::flash('error', 'overlap');
                # Zurück zur Übersicht
                return redirect()->back();
            }
        }

        # Wenn alles gut gegangen ist, Buchung erstellen
        $buchung = Buchungen::create([
            'notiz' => $request->notiz ?? '',
            'start' => $start->toDateTimeString(),
            'ende' => $ende->toDateTimeString(),
            'datum' => $request->datum,
            'raum' => $room->id,
        ]);

        # Zurück zur Übersicht
        return redirect()->back();
    }

    /**
     * Nimmt Löschanfragen entgegen
     * @param  Buchungen $buchung Die Buchung, die gelöscht werden soll
     *                            (via URL-Parameter übergeben)
     */
    public function deleteBuchung(Buchungen $buchung)
    {
        # Datenbankeintrag löschen
        $buchung->delete();

        #  Zurück zur Übersicht
        return redirect()->back();
    }

    /**
     * Impressum ausgeben
     */
    public function imprint()
    {
        return view('pages.imprint');
    }

    /**
     * Kontakt ausgeben
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /*
    public function book(Room $room)
    {
        return view('pages.book', ['room' => $room->load('buchungen')]);
    }
    */

    /*
    public function getRooms()
    {
        return Room::all();

        return Buchungen::all();

        return 'test';
    }
    */
    /*
    public function getBookedRoomsNow()
    {

        $buchungen = new Buchungen();

        $jetzt = new Carbon();


        $gebucht = $buchungen->where('start', '<', $jetzt)
            ->where('ende', '>', $jetzt)->get();

        return $gebucht;
    }
    */
}
