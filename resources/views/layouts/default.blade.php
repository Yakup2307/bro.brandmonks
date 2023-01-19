<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <!--link rel="stylesheet" href="/resources/demos/style.css"-->
    <link rel="stylesheet" href="/bootstrap-5.1.3-dist/css/bootstrap.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-gray-100">
            <header class="bg-white shadow">
                <nav x-data="{ open: false }" class="bg-gray-800">
                    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                        <div class="relative flex items-center justify-between h-16">
                            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                                <button @click="open = ! open"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    aria-expanded="false">
                                    <span class="sr-only">Open main menu</span>
                                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                                <div class="flex-shrink-0 flex items-center">
                                    <span class="text-white text-2xl font-bold">
                                        <font style="color:#f58220;">B</font>randmonks <font style="color:#f58220;">R</font>aumbelegungs <font style="color:#f58220;">O</font>rganisator
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Impressum</a>
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Kontakt</a>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
   
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Buchungsmenü</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="raum" >
                        <div class="column">
                            <div class="col-sm-4">
                                <label for="notiz"><b>Name</b></label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Enter Username" name="notiz" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="datum"><b>Datum</b></label>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" id="datum"
                                name="datum" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="2038-12-31">
                            </div>
                            <div class="col-sm-4">
                                <label for="appt-time"><b>Zeit</b></label>
                            </div>
                            <div class="col-sm-8">
                                <input id="appt-time" type="time" name="start" value="HH:mm" min="09:00" max="18:00" required>
                                <small>bis</small>
                                <label for="appt-time"></label>
                                <input id="appt-time" type="time" name="ende" value="HH:mm" min="09:00" max="18:00" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Speichern</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="/bootstrap-5.1.3-dist/js/bootstrap.js"></script>
</body>

</html>