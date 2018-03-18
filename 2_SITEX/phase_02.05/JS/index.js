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
            case "makeTable":
                var table=[];
                table = makeTable(retour[action]);
                $('#contenu').html(table).show(500);
                break;
            case "error":
                $('#' + action ).html(retour[action]).show(500);
                break;
            case "jsonError":
                $('#' + action ).html('Error : <br>'+ retour[action].error + '<hr> Json : '+ retour[action].json).show(500);
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
        var jError = {"jsonError":{}}
        var err = e.message
        jError.jsonError["error"] = err;
        jError.jsonError["json"] =json;
        console.log(JSON.stringify(jError));
        parsed = JSON.parse(JSON.stringify(jError));
        console.log(jError);
    }
    return parsed;
}

function makeTable(tab) {   //02.5.2.2
    /*console.log("From makeTable() \n Le type d    u tableau : " , /!*typeof tab *!/ tab.constructor.name+ '\n' , tab);
    return 'Allez voir en console ';*/
    /*var typeOfTab = tab.constructor.name;
    if(typeOfTab == 'Object') return makeTableFromObject(tab);
    else if(typeOfTab == 'Array') return makeTableFromArray(tab);*/
    var fonction = 'makeTableFrom' + tab.constructor.name;
    var out = window[fonction](tab);
    return out;
}

function makeTableFromObject(tab) {
    /*console.log("From makeTableFromObject() \n Le type du tableau : " , tab.constructor.name+ '\n' , tab);
    return 'Allez voir en console ';*/
    var firstElement = tab[Object.keys(tab)[0]];
    var elementType = firstElement.constructor.name;
    var fonction  = 'makeTheadFrom'+elementType;
    // console.log('mkfo ->' + fonction +'()' );
    var out = '<table calss = "myTab_Object">'
            + window[fonction](firstElement,elementType)
            + makeTbody(tab,'Object')
            + '</table>';
    //console.log(out);
    return out;
}

function makeTableFromArray(tab) {
    /*console.log("From makeTableFromArray() \n Le type du tableau : " , tab.constructor.name+ '\n' , tab);
    return 'Allez voir en console ';*/
    var firstElement = tab[0];
    var elmentType = firstElement.constructor.name;
    var fonction  = 'makeTheadFrom'+elmentType;
    // console.log('mkfo ->' + fonction +'()' );
    var out = '<table calss = "myTab_Array">'
        + window[fonction](firstElement,elmentType)
        + makeTbody(tab,'Array')
        + '</table>';
    // console.log(out);
    return out;
}

function makeTheadFromObject(el, type='Array'){
    var out = '<thead>\t<tr>\n\t\t<th>'+ (type=='Array'?'index':'clé')+'</th>'
    + Object.keys(el).map(function (x) { return '\t\t<th>' + x + '</th>'}).join('\n')
    + '\t</tr>\n</thead>\n';
    // console.log(out)
    return out;
}

function makeTheadFromArray( el, type='Array'){
    var out = '<thead>\t<tr>\n\t\t<th>'+ (type=='Array'?'index':'clé')+'</th>'
        + Object.keys(el).map(function (x) { return '\t\t<th>col_' + x + '</th>'}).join('\n')
        + '\t</tr>\n</thead>\n';
    console.log(out)
    return out;
}
function makeTbody(tab, type='Array') {
    var out='<tbody>'
        + Object.keys(tab)
            .map(function (k) { return '\t<tr id=' + (type=='Array'?'lig_':'') + k +'>\n\t\t<td>'+k+'</td>\n'
                                                            + Object.keys(tab[k])
                                                            .map(function (x) { return '\t\t<td>' + tab[k][x]+'</td>'})
                                                            .join('\n')+'\t</tr>'; }).join('\n') +'</tbody>';
    // console.log(out);
    return out;
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