/**
 * Formulaire du billetage
 * Remplissage automatique des champs
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
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
 * Calcul du montant total d'ouverture de caisse
 *
 * @author: Delrodie AMOIKON
 * @date 23/06/2017
 */
function caisseMat()
{
  var dixmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleMat"].value);
  var cinqmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleMat"].value);
  var deuxmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleMat"].value);
  var milleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_milleMat"].value);
  var cinqcentMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentMat"].value);
  var deuxcentMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentMat"].value);
  var centMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_centMat"].value);
  var cinquanteMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteMat"].value);
  var vingtcinqMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqMat"].value);
  var dixMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixMat"].value);
  var cinqMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqMat"].value);
  var totMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value);

  // Calcul de la somme totale
  dixMille  = 10000 * existance(dixmilleMat);
  cinqMille = 5000 * existance(cinqmilleMat);
  deuxMille = 2000 * existance(deuxmilleMat);
  mille     = 1000 * existance(milleMat);
  cinqCent  = 500 * existance(cinqcentMat);
  deuxCent  = 200 * existance(deuxcentMat);
  cent      = 100 * existance(centMat);
  cinquante = 50 * existance(cinquanteMat);
  vingtcinq  = 25 * existance(vingtcinqMat);
  dix       = 10 * existance(dixMat);
  cinq      = 5 * existance(cinqMat);

  // Calcul de la monnaie
  var total = dixMille + cinqMille + deuxMille + mille + cinqCent + deuxCent + cent + cinquante + vingtcinq + dix + cinq;

  return existance(total);
}

/**
 * Traitement du formulaire du billetage selon 10.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function dixmilleMat()
{
    var dixmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleMat"].value);

    if (!isNaN(dixmilleMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 5.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinqmilleMat()
{
    var cinqmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleMat"].value);

    if (!isNaN(cinqmilleMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 2.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function deuxmilleMat()
{
    var deuxmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleMat"].value);

    if (!isNaN(deuxmilleMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 1.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function milleMat()
{
    var milleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_milleMat"].value);

    if (!isNaN(milleMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_milleMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 500
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinqcentMat()
{
    var cinqcentMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentMat"].value);

    if (!isNaN(cinqcentMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 200
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function deuxcentMat()
{
    var deuxcentMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentMat"].value);

    if (!isNaN(deuxcentMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 100
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function centMat()
{
    var centMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_centMat"].value);

    if (!isNaN(centMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_centMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 50
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinquanteMat()
{
    var cinquanteMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteMat"].value);

    if (!isNaN(cinquanteMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 25
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function vingtcinqMat()
{
    var vingtcinqMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqMat"].value);

    if (!isNaN(vingtcinqMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 10
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function dixMat()
{
    var dixMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixMat"].value);

    if (!isNaN(dixMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_dixMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}

/**
 * Traitement du formulaire du billetage selon 5
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinqMat()
{
    var cinqMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqMat"].value);

    if (!isNaN(cinqMat)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinqMat"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value = caisseMat();
    }
}


/*
=======================================================================
================== SOIR ============================
======================================================================= */

/**
 * Calcul du montant total de cloture
 *
 * @author: Delrodie AMOIKON
 * @date 27/06/2017
 */
function caisseSoir()
{
  var dixmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleMat"].value);
  var cinqmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleMat"].value);
  var deuxmilleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleMat"].value);
  var milleMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_milleMat"].value);
  var cinqcentMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentMat"].value);
  var deuxcentMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentMat"].value);
  var centMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_centMat"].value);
  var cinquanteMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteMat"].value);
  var vingtcinqMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqMat"].value);
  var dixMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixMat"].value);
  var cinqMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqMat"].value);
  var totMat = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_totMat"].value);

  var dixmilleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleSoir"].value);
  var cinqmilleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleSoir"].value);
  var deuxmilleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleSoir"].value);
  var milleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_milleSoir"].value);
  var cinqcentSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentSoir"].value);
  var deuxcentSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentSoir"].value);
  var centSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_centSoir"].value);
  var cinquanteSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteSoir"].value);
  var vingtcinqSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqSoir"].value);
  var dixSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixSoir"].value);
  var cinqSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqSoir"].value);
  var totSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value);

  // Calcul de la somme totale
  dixMille  = 10000 * existance(dixmilleSoir);
  cinqMille = 5000 * existance(cinqmilleSoir);
  deuxMille = 2000 * existance(deuxmilleSoir);
  mille     = 1000 * existance(milleSoir);
  cinqCent  = 500 * existance(cinqcentSoir);
  deuxCent  = 200 * existance(deuxcentSoir);
  cent      = 100 * existance(centSoir);
  cinquante = 50 * existance(cinquanteSoir);
  vingtcinq  = 25 * existance(vingtcinqSoir);
  dix       = 10 * existance(dixSoir);
  cinq      = 5 * existance(cinqSoir);

  // Calcul de la monnaie
  var total = dixMille + cinqMille + deuxMille + mille + cinqCent + deuxCent + cent + cinquante + vingtcinq + dix + cinq;

  return existance(total);
}


/**
 * Traitement du formulaire du billetage selon 10.000
 *
 * @author: Delrodie AMOIKON
 * @date: 27/06/2017
 */
function dixmilleSoir()
{
    var dixmilleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleSoir"].value);

    if (!isNaN(dixmilleSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_dixmilleSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 5.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinqmilleSoir()
{
    var cinqmilleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleSoir"].value);

    if (!isNaN(cinqmilleSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinqmilleSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 2.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function deuxmilleSoir()
{
    var deuxmilleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleSoir"].value);

    if (!isNaN(deuxmilleSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_deuxmilleSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 1.000
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function milleSoir()
{
    var milleSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_milleSoir"].value);

    if (!isNaN(milleSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_milleSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 500
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinqcentSoir()
{
    var cinqcentSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentSoir"].value);

    if (!isNaN(cinqcentSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinqcentSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 200
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function deuxcentSoir()
{
    var deuxcentSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentSoir"].value);

    if (!isNaN(deuxcentSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_deuxcentSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 100
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function centSoir()
{
    var centSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_centSoir"].value);

    if (!isNaN(centSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_centSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 50
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinquanteSoir()
{
    var cinquanteSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteSoir"].value);

    if (!isNaN(cinquanteSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinquanteSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 25
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function vingtcinqSoir()
{
    var vingtcinqSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqSoir"].value);

    if (!isNaN(vingtcinqSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_vingtcinqSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 10
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function dixSoir()
{
    var dixSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_dixSoir"].value);

    if (!isNaN(dixSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_dixSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}

/**
 * Traitement du formulaire du billetage selon 5
 *
 * @author: Delrodie AMOIKON
 * @date: 23/06/2017
 */
function cinqSoir()
{
    var cinqSoir = parseFloat(document.getElementById("billetageForm").elements["appbundle_arrete_cinqSoir"].value);

    if (!isNaN(cinqSoir)) {
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    } else {
      document.getElementById("billetageForm").elements["appbundle_arrete_cinqSoir"].value = 0;
      document.getElementById("billetageForm").elements["appbundle_arrete_totSoir"].value = caisseSoir();
    }
}
