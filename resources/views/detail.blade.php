@if (file_exists(public_path("/images/Lignes/$ligneBus.gif")))
    <img src="/images/Lignes/{{$ligneBus}}.gif" alt="{{$ligneBus}}" class="icon_bus"/>
@else
    {{$ligneBus}}&nbsp;&nbsp;
@endif
<h2 class="detailh2">{{$direction}}</h2>
<span style="padding-left:10px;">
    <input type="date" class="detail_date" id="date_bus" name="date_bus" value="{{$date}}" min="{{$date}}" max="{{date("Y")+1}}-01-01"
    data-codeLieu="{{$codeLieu}}" data-sens="{{$sens}}"
    data-terminus="{{$terminus}}" data-bus="{{$ligneBus}}"
    />
</span>
<span style="float: right;padding-bottom:5px;"><input type="button" class="btn btn-primary" value="Fermer" onclick="$(this).parent().parent().addClass('hidden');"></span>
<table class="table table-striped">
    @foreach($horaires as $heure => $minutes)
        <tr @if ((int) $heure == date("H")) class="active" @endif>
            <td>{{$heure}}</td>
                @foreach ($minutes as $minute)
                    <td>{{$minute}}</td>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>
