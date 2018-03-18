// phase00.08.1
function appelAjax(aValue,event) {
    event.preventDefault();
    console.log(aValue.attributes.href.value.split(".")[0]);
    console.log(event.isDefaultPrevented() );
    console.log(aValue);  // pas là mais directement dant l'event clic
    var request = $(aValue).attr("href").split(".")[0];
    $.get('/TP/2T/RES/appelAjax.php?rq='+ request,gereRetour)
}
function gereRetour(retour) {
    retour=testJson(retour);
    $('#contenu').html(retour);
}
function testJson(json) {
    var parsed;
    try {
        parsed = JSON.parse(json);
        parsed = "C'est bien du JSON dont les cl&eacutes sont : <hr>"
                + Object.keys(parsed).join(" - ")
                + "<hr>"
                + json;
    }catch (e){
        parsed = json;
    }
    return parsed;
}

$('document').ready(function() {

    //$('#credits a').prop('target', '_blank');   // 5.3 a partir de ready(), modifiez les liens du span credits, pour qu'ils
    $("#credits a").attr('target', '_blank');                                            // s'ouvrent dans une nouvelle page ( un nouvel onglet )
    $('#credits').hide();
    // $("span:contains('crédits')").mouseover(function(){  // this block and the block begin to 9 is the same
    //     $('#credits').stop().show();
    // });
    // $("span:contains('crédits')").mouseout(function(){
    //     $('#credits').stop().hide();
    // });
    $("span:contains('crédits')").hover(function(){
        $('#credits').show()}, function(){ $('#credits').hide()})
    // this lines are alternative with $("span:contains('crédits')") in the line precendent
    //$("span").filter(function() { re  turn ($(this).text().indexOf('crédits') > -1) }); -- anywhere match
    //$("span").filter(function() { return ($(this).text() === 'crédits') }); -- exact match


     //phase00.06.3
        //$('.menu a').click(function(event){
        //    appelAjax(event);
        //    event.preventDefault();
        //    console.log(this);
        //    console.log(event.isDefaultPrevented() );
        //    console.log(this.attributes.href.value.split(".")[0]);
        //    request = $(this).attr('href').split(".")[0];
        //});
        $('.menu a').on('click',function(event){
            appelAjax(this,event);
        });
    // phase00.07 fucos on anchor Accueil
    $("ul li:first a").focus();
});