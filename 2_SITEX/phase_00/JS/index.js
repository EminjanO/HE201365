
function appelAjax() {
    $.get('/TP/2T/RES/appelHTML.php?rq=config',function(retour){
        $('#contenu').html(retour);
    })
}
// je suis au point 3 de point 6 :-)

$('document').ready(function() {
    $('#credits a').prop('target', '_blank');   // 5.3 a partir de ready(), modifiez les lizns du span credits, pour qu'ils
                                                // s'ouvrent dans une nouvelle page ( un nouvel onglet )
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
    //$("span").filter(function() { return ($(this).text().indexOf('crédits') > -1) }); -- anywhere match
    //$("span").filter(function() { return ($(this).text() === 'crédits') }); -- exact match
});