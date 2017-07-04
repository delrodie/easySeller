/**
 * Calcul de la maonnaie de la facture
 * Remplissage automatique des champs
 * @author: Delrodie AMOIKON
 * @date: 02/05/2017
 * @version: v1.0
 */

//Formatage de la monnaie
function format(number) {
    var numberStr = parseFloat(number).toFixed(2).toString();
    var numFormatDec = numberStr.slice(-2); /*decimal 00*/
    numberStr = numberStr.substring(0, numberStr.length - 3); /*cut last 3 strings*/
    var numFormat = new Array;
    while (numberStr.length > 3) {
        numFormat.unshift(numberStr.slice(-3));
        numberStr = numberStr.substring(0, numberStr.length - 3);
    }
    numFormat.unshift(numberStr);
    return numFormat.join('.'); /*+','+numFormatDec format 000.000.000,00 */
}

/**
 * Test de l'existence de la valeur
 * Si valeur supérieure a 0 alors garder valeur
 * Sinon affecter a valeur 0
 *
 * @author Delrodie AMOIKON
 * @date 02/05/2017
 */
function existance(number) {
    if (number > 0) {
        return number;
    } else {
        return 0;
    }
}

/**
 * Traitement du formulaire selon la remise
 *
 * author Delrodie AMOIKON
 * date: 02/05/2017
 */
function remise() {
    // Manipulation de la valeur de la remise
    var remise = parseFloat(document.getElementById("validationFacture").elements["appbundle_facture_remise"].value);

    if (!isNaN(remise)) {
        //Recuperation des valeurs des autres champs du facture
        var tamMTT = parseFloat(document.getElementById("validationFacture").elements["facture_totaux"].value);
        var tamVerse = parseFloat(document.getElementById("validationFacture").elements["appbundle_facture_verse"].value);
        var tamNap = parseFloat(document.getElementById("validationFacture").elements["appbundle_facture_nap"].value);
        var tamMonnaie = parseFloat(document.getElementById("validationFacture").elements["facture_monnaie"].value);

        // Si la remise est superieure a 100 alors deduire du montant total le montant de la remise
        // Sinon deduire du montant le pourcentage de remise
        if (remise > 100) {
            var nap = existance(tamMTT) - existance(remise);
        } else {
            var nap = existance(tamMTT) * (1 - (existance(remise) / 100));
        }

        // Calcul de la monnaie
        var monnaie = existance(tamVerse) - existance(nap);

        document.getElementById("validationFacture").elements["appbundle_facture_nap"].value = existance(nap);
        document.getElementById("validationFacture").elements["facture_monnaie"].value = existance(monnaie);
        document.getElementById("validationFacture").elements["appbundle_facture_verse"].value = existance(tamVerse);

    } else {
        alert('La remise saisie est incorrect. Ne mettez ni d\'espace, ni de point, ni le symbole de pourcentage')
    }

}

/**
 * Traitement du formulaire selon le montant verse
 *
 * @author: Delrodie AMOIKON
 * @date: 02/05/2017
 */
function verse() {
    // Manipulation de la valeur de la remise
    var verse = parseFloat(document.getElementById("validationFacture").elements["appbundle_facture_verse"].value);

    if (!isNaN(verse)) {
        //Recuperation des valeurs des autres champs du facture
        var tamMTT = parseFloat(document.getElementById("validationFacture").elements["facture_totaux"].value);
        //var tamRemise = parseFloat(document.getElementById("validationFacture").elements["appbundle_facture_remise"].value);
        //var tamNap = parseFloat(document.getElementById("validationFacture").elements["facture_nap"].value);
        var tamMonnaie = parseFloat(document.getElementById("validationFacture").elements["facture_monnaie"].value);

        // Calcul du net a payer
        // Si la remise est superieure a 100 alors deduire du montant total le montant de la remise
        // Sinon deduire du montant le pourcentage de remise
        /*if (tamRemise > 100) {
            var nap = existance(tamMTT) - existance(tamRemise);
        } else {
            var nap = existance(tamMTT) * (1 - (existance(tamRemise) / 100));
        }*/

        // Calcul de la monnaie
        var monnaie = existance(verse) - existance(tamMTT);

        //document.getElementById("validationFacture").elements["facture_nap"].value = existance(tamNap);
        document.getElementById("validationFacture").elements["facture_monnaie"].value = monnaie;
        //document.getElementById("validationFacture").elements["appbundle_facture_remise"].value = existance(tamRemise);

    } else {
        alert('Le montant versé saisi est incorrect. Ne mettez ni d\'espace, ni de point')
    }
}
