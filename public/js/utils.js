var MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

var lastSync = 0;
var syncInterval = 60000; //sync every minute

function syncPage() {
    lastSync = new Date().getTime(); //set last sync to be now
    relaunchPage();
}

setInterval(function() {
    var now = new Date().getTime();
    if ((now - lastSync) > syncInterval ) {
        syncPage();
    }
}, 5000);

function geoFindMe() {
    const status = document.querySelector("#status");

    function success(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        window.location = `/dashboard/${latitude}/${longitude}`;
    }

    function error() {
        if (status) {
            status.textContent = "Unable to retrieve your location";
        }
    }

    if (!navigator.geolocation) {
        if (status) {
            status.textContent = "La Géolocalisation n'est pas supporté par votre navigateur";
        }
    } else {
        if (status) {
            status.textContent = "Localisation en cours...";
        }
        navigator.geolocation.getCurrentPosition(success, error);
    }
}

function refreshArret(accordionId, codeLieu) {
    $(accordionId).load("/refreshArret/"+codeLieu, function( response, status, xhr ) {
        if ( status === "success" ) {
            refreshDetails();
        }
    });
}

function refreshDetails() {
    $(".detail_bus").unbind("click");
    $(".detail_bus").click(function(){
        $("#detail_block").removeClass("hidden");
        $("header").removeClass("hidden");
        let url = "/detailArret/"+$(this).attr('data-bus')+"/"+$(this).attr('data-codeLieu')+"/"+$(this).attr('data-sens')+"/-";
        $("#detail_block").load(url, function( response, status, xhr ) {
            if ( status === "success" ) {
                refreshDetails()
            }
        });
    });

    $(".detail_date").unbind("change");
    $(".detail_date").change(function(){
        $("#detail_block").removeClass("hidden");
        $("header").removeClass("hidden");
        let url = "/detailArret/"+$(this).attr('data-bus')+"/"+$(this).attr('data-codeLieu')+"/"+$(this).attr('data-sens')+"/"+$(this).val();
        $("#detail_block").load(url, function( response, status, xhr ) {
            if ( status === "success" ) {
                refreshDetails()
            }
        });
    });
}

function refreshFavorisArret(accordionId, codeLieu, bus) {
    $(accordionId).load("/refreshFavorisArret/"+codeLieu+"/"+bus, function( response, status, xhr ) {
        if ( status === "success" ) {
            refreshDetails();
        }
    });
}

function refreshPerturbations() {
    const fetchPromise = fetch("/perturbations");
    fetchPromise.then(response => {
        return response.json();
    }).then(perturbations => {
        for (const [key, value] of Object.entries(perturbations)) {
            $(".icon-warning-"+key).css("display","inline");
            $(".warning-"+key).html(value);
        }
    });
}

let wakeLock = null;
let wakeLockToggle = null;
window.onload = function(e) {
    relaunchPage();
}

$(document).ready(function() {
    $.ajaxSetup ({
        cache: false
    });

    if (getCookie("gps") == "1") {
        document.getElementById("logo-gps").classList.add("active");
    }

    if (getCookie("screen") == "1") {
        document.getElementById("logo-mobile-screen").classList.add("active");
    }

    $("#logo-gps").click(function(){
        let msg = "activé";
        this.classList.toggle("active");
        if (this.classList.contains("active")) {
            setCookie("gps",1,1);
        } else {
            setCookie("gps",0,1);
            msg = "désactivé";
        }
        showAlert("Localisation temps réél " +msg, false);
        geoFindMe();
    });

    $("#logo-mobile-screen").click(function(){
        let msg = "activé";
        this.classList.toggle("active");
        if (this.classList.contains("active")) {
            setCookie("screen",1,1);
            relaunchPage();
        } else {
            setCookie("screen",0,1);
            msg = "désactivé";
        }

        showAlert("Blocage écran allumé " +msg, false);
    });

    $( "#searchArret" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "/listArrets",
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $('#searchArret').val(ui.item.label);
            $('#formGoto').submit();
            return false;
        }
    });

    $(".findArret").click(function(){
        this.classList.toggle("active");
        if (this.classList.contains("active")) {
            document.getElementById("formGoto").classList.remove("hidden");
            $("header").removeClass("hidden");
            document.getElementById("searchArret").focus();
        } else {
            document.getElementById("formGoto").classList.add("hidden");
            $("header").addClass("hidden");
        }
    });
    relaunchPage();
});

const wakeLockEnable = async () => {
    try {
        wakeLock = await navigator.wakeLock.request('screen');
    } catch (err) {
        console.error(`${err.name}, ${err.message}`);
    }
}

function relaunchPage(){
    window.setInterval(function(){
        if ($("#logo-gps").hasClass("active")){
            geoFindMe();
        }
    },60000*5);

    wakeLockToggle = document.querySelector("#logo-mobile-screen");
    if ('wakeLock' in navigator) {
        if ($('#logo-mobile-screen').hasClass("active")) {
            wakeLockEnable();
        } else {
            if (wakeLock) {
                wakeLock.release()
                    .then(() => {
                        wakeLock = null;
                    });
            }
        }
    }
}

function loadAlarmsButtons() {
    $(".favorite").click(function(){
        $(this).toggleClass("yellow");
        let msg = 'Favori ajouté';
        if ($(this).hasClass("yellow")) {
            msg = 'Favori retiré';
        }
        $.ajax({
            url: "/addFavorite/"+$(this).attr('data-arret')+"/"+$(this).attr('data-bus'),
            type: 'GET',
            dataType: "json",
            success: function(data) {
                showAlert(msg, false);
            }
        });
    });

    $(".alarm").click(function(){
        $(this).toggleClass("fa-bell fa-bell-slash");
        let codeLieu = $(this).attr('data-codeLieu');
        if ($(this).hasClass('fa-bell')) {
            $('header').show();
            let bus = $(this).attr('data-bus')
            let uuid = Date.now();
            let dateFutur = dateAdd(new Date(), 'minute', $(this).attr('data-alarm'));
            let hour = dateFutur.getHours();
            if (hour < 10) {
                hour = '0'+hour;
            }
            let minutes =  dateFutur.getMinutes();
            if (minutes < 10) {
                minutes = '0'+minutes;
            }
            dateFutur = hour + ':'+minutes;

            $(this).attr('data-uuid', uuid);
            document.getElementById("alarms_block").classList.remove('hidden');
            $("#alarms").append("<li class='pointer' onclick='removeAlarm(this)' id='alarm_"+uuid+"'><i class='fa-solid fa-bell pointer' data-codeLieu='"+codeLieu+"' data-uuid='"+uuid+"'></i>&nbsp;&nbsp;Alarme du bus " +bus+" ("+dateFutur+")</li>")
            window['alarm_' + uuid] = window.setTimeout(function (){
                if ('vibrate' in navigator) {
                    window.navigator.vibrate(2000);
                }
                let audio = new Audio("/sounds/beep.mp3");
                audio.play();

                showAlert("Alarme du bus " +bus, true);
                $("#alarm_"+uuid).remove();
            }, $(this).attr('data-alarm')*60000);
        } else {
            $('header').hide();
            document.getElementById("alarm_"+this.getAttribute('data-uuid')).click();
            refreshArret('#collapse'+MD5(codeLieu), codeLieu);
        }
        checkWakeLock();
    });
}

function removeAlarm(button) {
    clearTimeout(window[$(button).attr('id')]);
    $(button).remove();
    checkWakeLock();
}

function checkWakeLock() {
    if ($("#alarms li").length > 0) {
        if (!$('#logo-mobile-screen').hasClass("active")) {
            $("#logo-mobile-screen").click();
        }
    } else {
        if ($('#logo-mobile-screen').hasClass("active")) {
            $("#logo-mobile-screen").click();
        }
    }
}

/**
 * Adds time to a date. Modelled after MySQL DATE_ADD function.
 * Example: dateAdd(new Date(), 'minute', 30)  //returns 30 minutes from now.
 * https://stackoverflow.com/a/1214753/18511
 *
 * @param date  Date to start with
 * @param interval  One of: year, quarter, month, week, day, hour, minute, second
 * @param units  Number of units of the given interval to add.
 */
function dateAdd(date, interval, units) {
    if(!(date instanceof Date))
        return undefined;
    var ret = new Date(date); //don't change original date
    var checkRollover = function() { if(ret.getDate() != date.getDate()) ret.setDate(0);};
    switch(String(interval).toLowerCase()) {
        case 'year'   :  ret.setFullYear(ret.getFullYear() + units); checkRollover();  break;
        case 'quarter':  ret.setMonth(ret.getMonth() + 3*units); checkRollover();  break;
        case 'month'  :  ret.setMonth(ret.getMonth() + units); checkRollover();  break;
        case 'week'   :  ret.setDate(ret.getDate() + 7*units);  break;
        case 'day'    :  ret.setDate(ret.getDate() + units);  break;
        case 'hour'   :  ret.setTime(ret.getTime() + units*3600000);  break;
        case 'minute' :  ret.setTime(ret.getTime() + units*60000);  break;
        case 'second' :  ret.setTime(ret.getTime() + units*1000);  break;
        default       :  ret = undefined;  break;
    }
    return ret;
}

function showAlert(msg, checkWake) {
    $('#alert').removeClass('hidden').html(msg).alert();
    window.setTimeout(function () {
        $("#alert").addClass('hidden');
        if (checkWake) {
            checkWakeLock();
        }
    }, 3000);
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
