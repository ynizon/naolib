<x-app-layout>
    <x-slot name="header">
        <div class="row  px-5">
            <form action="/goto" method="post" id="formGoto" class="hidden">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="Cherchez un arrêt" name="q" id="searchArret">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="form-control mb-3 btn btn-primary" value="Rechercher">
                    </div>
                </div>
            </form>

            <div id="alarms_block" class="col-md-12 hidden">
                <ul id="alarms">
                </ul>
            </div>

            <div id="detail_block" class="col-md-12 hidden">

            </div>
        </div>
    </x-slot>

    <input type="hidden" id="pref-alarm" value="{{$prefAlarm}}" />

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    @if ($lat == '' && $lng == '')
                        <p id="status" class="p-6"></p>

                        <script>
                            geoFindMe();
                        </script>
                    @else
                        <div class="accordion" id="accordionBus">
                            @if (Auth::user() && !isset($_GET["ou"]))
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingX">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="true" aria-controls="collapseX">
                                            Favoris
                                        </button>
                                    </h2>
                                    <div id="collapseX" class="accordion-collapse collaps show" aria-labelledby="headingX" data-bs-parent="#accordionBus">
                                        <div class="accordion-body">
                                            <ul class="nopad">
                                                @foreach($favorites as $codeLieu => $allBus)
                                                    @foreach ($allBus as $ligneBus)
                                                        <li class="bus1">
                                                            <div class="row" id="favoris-{{$codeLieu}}-{{$ligneBus}}">
                                                            </div>
                                                        </li>
                                                        <script>
                                                            refreshFavorisArret('#favoris-{{$codeLieu}}-{{$ligneBus}}', '{{$codeLieu}}', '{{$ligneBus}}');
                                                        </script>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @foreach($content as $info)
                                @if (count($info['ligne']) > 0)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{md5($info['codeLieu'])}}">
                                            <button class="accordion-button  @if (!isset($_GET["ou"]) || $_GET["ou"] != $info['libelle']) collapsed @endif" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{md5($info['codeLieu'])}}"
                                                    aria-expanded="true" aria-controls="collapse{{md5($info['codeLieu'])}}">
                                                {{$info['libelle']}} ({{$info['distance']}})
                                            </button>
                                        </h2>
                                        <div id="collapse{{md5($info['codeLieu'])}}" class="accordion-collapse collapse @if (isset($_GET["ou"]) && $_GET["ou"] == $info['libelle']) show @endif"
                                             aria-labelledby="heading{{md5($info['codeLieu'])}}" data-bs-parent="#accordionBus">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <script>
                            function refreshArrets() {
                                @if (Auth::user() && !isset($_GET["ou"]))
                                    @foreach($favorites as $codeLieu => $allBus)
                                        @foreach ($allBus as $ligneBus)
                                            refreshFavorisArret('#favoris-{{$codeLieu}}-{{$ligneBus}}', '{{$codeLieu}}', '{{$ligneBus}}');
                                        @endforeach
                                    @endforeach
                                @endif
                                @foreach($content as $info)
                                    @if (count($info['ligne']) > 0)
                                        refreshArret('#collapse{{md5($info['codeLieu'])}}', '{{$info['codeLieu']}}');
                                    @endif
                                @endforeach

                                window.setTimeout(function(){
                                    refreshPerturbations();
                                    loadAlarmsButtons();
                                }, 2000);
                            }

                            window.setInterval(function() {
                                refreshArrets();
                            }, 60000);

                            refreshArrets();
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
