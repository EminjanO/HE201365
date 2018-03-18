<section id="tpsem05">
    <fieldset id="tp05search">
        <legend>Groupe recherché</legend>
        <form name="recherche" onsubmit="return false">
            <input type="text" name="zoneSearch" title="nom de la groupe" placeholder="nom du groupe recherché"
                   oninput="filtre_v2(this)" id="zSearch" value=""/> <br>
            <div>
                <span title="début(Begin)">
                    <label for="DEVANT"><<</label>
                    <input onchange="filtre_v2(this.form.zSearch)" type="radio" name="part" id="DEVANT" value="B">
                </span>
                <span title="au milieu(middle)">
                    <label for="DANS">></label>
                    <input onchange="filtre_v2(this.form.zSearch)" type="radio" name="part" id="DANS" value="I" checked>
                    <label for="DANS"><</label>
                </span>
                <span title="fin(after)">
                    <input onchange="filtre_v2(this.form.zSearch)" type="radio" name="part" id="DERRIERE" value="E">
                    <label for="DERRIERE">>></label>
                </span>
            </div>
        </form>
    </fieldset>
    <fieldset id="tp05select">
        <legend id="bLegend">Suggestion</legend>
        <form name="suges" title="choisissez le groupe à afficher" id="selec" onsubmit="return false">
            <legend>Suggestion <span id="nb"></span></legend>
            <form id="suges">
                <select name="formSelect" id="select" size=0 title="choisissez le groupe à afficher">
                </select>
            </form>
        </form>
    </fieldset>
    <fieldset id="tp05result">
        <legend>Liste des cours</legend>
            <p>
                Pas de groupe sélectionné
            </p>
            <div></div>
    </fieldset>
</section>
<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/14/2018
 * Time: 7:06 AM
 */