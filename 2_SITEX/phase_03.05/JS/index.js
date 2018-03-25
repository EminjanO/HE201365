// sem 05 1.2.5
var myData = [];

// phase00.08.1
function appelAjax(aValue,senderId) {
    $.ajaxSetup({processData: false,contentType: false}); // indique à jQuery de ne pas traiter les données
                                                  // indique à jQuery de ne pas configurer le contentType)

    console.log(arguments.callee.name,aValue);
    var data= new FormData();   //{};
    var request = 'unknownUri';
    switch (true){
        case Boolean(aValue.href) :
            request = $(aValue).attr("href").split(".html")[0];
            break;
        case Boolean(aValue.action) :
            request = $(aValue).attr("action").split(".html")[0];
            data = new FormData(aValue);
            break;
    }
    console.log(aValue.select);
    data.append('senderId',senderId);  //data.senderId=aValue.id;
    $.post('?rq='+request,data,gereRetour);
    console.log(data);
}
/* pour  sem05 1.4.3
jQuery.post( url, [ data ], [ success
(data, textStatus, XMLHttpRequest) ],
[ dataType ] )*/

function gereRetour(retour) {
    retour = testJson(retour);
    /*$('#contenu').html(retour);
    var a = 'makeTable';
    console.log(retour[a])*/
    let distination = '#contenu';               // 1.6.5 of sem05 below 3 lines
    // j'ai pas bien compris ici aussi mais j'ai fait, pourquoi on fait ça ? c'est quoi l'intéré ?
    if(typeof retour['distination']){           //si destination existe
        distination = retour['destination'];    // prise en compte
        console.log(retour['destination'])
        delete (retour['destination']);         // suppression de la liste
    }
    for (let action in retour)
    {
        switch (action)
        {
            case "display":
                $('#contenu').html(retour[action]);
                break;
            case "formTP05":
                $('#contenu').html(retour[action]);
                myData['allGroups'] = JSON.parse( retour['data']);
                // console.log( retour['data']);
                //$('#debug').html(makeOptions(myData['allGroups'],'nom','nom')).fadeIn(500);
                $('#select').html(makeOptions(myData['allGroups'],'nom','nom'));
                console.log($('#select option').length);
                $('#selec').change(function () {  //c'est la référence du formulaire qui doit être passé à la fonction. Pas celle du select !
                    //$('#debug').html(appelAjax(this, "formTP05")).fadeIn();
                    appelAjax(this, "formTP05");
                    console.log(this.parentElement);
                })
                if(myData['allGroups'].length<10)
                {
                    $('#select').attr('size',myData['allGroups'].length);
                    console.log($('#select').attr('size'));
                }
                if(myData['allGroups'].length>10)
                {
                    $('#select').css('overflowY', 'scroll');
                    console.log($('#select').attr('size'));
                }
                break;
            case 'cacher ': //$(retour['cacher']).fadeOut(500);
                console.log(retour[action]);
                break;
            case 'montrer':$(montrer).fadeIn(500);break;
            case "makeTable":
                var table=[];
                table = makeTable(retour[action]);
                // let distination = (retour['destination'] ? retour['destination'] : '#contenu'); // 1.6.4 of sem05
                $(distination).html(table).show(500);
                $(retou).fadeOut();
                console.log(distination);
                break;
            case "debug":   // 05 1.4.1
                    $('#' + action ).html(retour[action]).fadeIn(500);
                    break;
            case "error":
                $('#' + action ).html(retour[action]).fadeIn(500);
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
// sem05 1.3.1
function makeOptions(l, v, a) { // liste, value, affichage
    return l.map(function (o) {
        return '<option value =' + o[v] + '>' + o[a] + '</option>'
    }).join('\n');
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
        appelAjax(this, this.id);

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