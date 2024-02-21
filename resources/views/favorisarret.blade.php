<div class="col">
    <a target="_blank" class="link_bus" href="https://naolib.fr/fr/fiche-horaires-ligne-{{$ligneBus}}" title="Voir la fiche horaire {{$ligneBus}}">
        @if (file_exists(public_path("/images/Lignes/$ligneBus.gif")))
            <img src="/images/Lignes/{{$ligneBus}}.gif" alt="{{$ligneBus}}" class="icon_bus"/></a>
        @else
            {{$ligneBus}}</a>&nbsp;&nbsp;
        @endif

    <i class="yellow favorite fa fa-star pointer" data-bus="{{$ligneBus}}" data-arret="{{$codeLieu}}"></i>
    <br/>
    <img src='/images/Infotrafic/Info-trafic.jpg' class="icon-warning icon-warning-{{$ligneBus}}" alt="Infotrafic"/>
    <a href="#" onclick="$('#collapse{{md5($codeLieu)}}').toggleClass('show');">{{$arretsCodes[$codeLieu]}}</a>
</div>
@foreach($horaires as $terminus => $horaireTerminus)
    <div class="col">
        <b class="detail_bus" data-codeLieu="{{$codeLieu}}" data-sens="{{Utils::getSensBus($terminus)}}"
           data-terminus="{{$terminus}}" data-bus="{{$ligneBus}}" >{{Utils::getNomBus($terminus)}}</b>

        @foreach ($horaireTerminus as $horaire)
            <div class="timing" >
                <span class="timing-clock">
                    @if ((int) $horaire['temps'] - $prefAlarm >= 0)
                        <i class="alarm fa-solid fa-bell-slash pointer"
                           data-codeLieu="{{$codeLieu}}"
                           data-bus="{{$ligneBus}}"
                           data-sens="{{Utils::getSensBus($terminus)}}"
                           data-alarm="{{(int) $horaire['temps'] - $prefAlarm}}"></i>
                    @endif
                </span>
                {{$horaire['temps']}}
            </div>
        @endforeach
    </div>
@endforeach
