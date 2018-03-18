// phase00.08.1
function appelAjax(aValue, event) {
    event.preventDefault();
    /*    console.log(aValue.attributes.href.value.split(".")[0]);
        console.log(event.isDefaultPrevented() );
        console.log(aValue);  // pas là mais directement dant l'event clic*/
    var request = $(aValue).attr("href").split(".")[0];
    $.get('./index.php?rq=' + request, gereRetour)
}

function gereRetour(retour) {
    retour = testJson(retour);
    /*$('#contenu').html(retour);
    var a = 'makeTable';
    console.log(retour[a])*/
    for (var action in retour)
    {
        switch (action)
        {
            case "display":
                $('#contenu').html(retour[action]);
                break;
            case "error":
                $('#' + action ).html(retour[action]).show(500);
                break;
            default:
                console.log('action inconnue : ' + action +'\n', retour[action] );
        }
    }
}

function testJson(json) {
    var parsed;
    try {
        parsed = JSON.parse(json);
    } catch (e) {
        console.log('jsonError : ' + json);
    }
    return parsed;
}

$('document').ready(function () {
    $("#credits a").attr('target', '_blank');                                            // s'ouvrent dans une nouvelle page ( un nouvel onglet )
    $('#credits').hide();

    $("span:contains('crédits')").hover(function () {
        $('#credits').show()
    }, function () {
        $('#credits').hide()
    });

    $('.menu a').on('click', function (event) {
        event.preventDefault();
        $('.menu a').removeClass('selected');
        $(this).addClass('selected');
        appelAjax(this, event);

    });
    $("ul li:first a")/*.focus(); // <-ph01.01>
            $('#menu a:first')*/.addClass('selected');
    // phase02.3.1
    $("#global").after("<section id='gestion'></section>");
    $("#gestion").append("<aside id='error'></aside>" +    //phase02.4.4.2
                        "<aside id='message'></aside>" +
                        "<aside id='debug'></aside>" +
                        "<aside id='jsonError'></aside>" +
                        "<aside id='kint'></aside>");
    $("section#gestion> aside").hide();
    $("section#gestion> aside").dblclick(function () {
        $("section#gestion> aside").hide(500);
    })
});