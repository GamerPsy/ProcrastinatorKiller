var dateNaissance = new Date("1978-05-27");
var ageRetraite = 65;
var esperanceVie = 90;
var dateDuJour = new Date();
var ageActuel = dateDuJour.getFullYear() - dateNaissance.getFullYear();

// Vérification si l'anniversaire a déjà eu lieu cette année
if (dateDuJour.getMonth() < dateNaissance.getMonth() || (dateDuJour.getMonth() === dateNaissance.getMonth() && dateDuJour.getDate() < dateNaissance.getDate())) {
    ageActuel--;
}



/////////////////////////////////////////////////////////////////////////////////
/////////////////////               Les fonctions         ///////////////////////
/////////////////////////////////////////////////////////////////////////////////

// Fonction pour obtenir le numéro de la semaine
Date.prototype.getWeek = function () {
    var date = new Date(this.getTime());
    date.setHours(0, 0, 0, 0);
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
    var week1 = new Date(date.getFullYear(), 0, 4);
    return 1 + Math.round(((date - week1) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
};

function dessineLignes(nbLignes, numDepartLigne, type) {
    let numeroSemaine = dateDuJour.getWeek();

    if (type == "consomme") {
        nbSemaineRestantes = 52 - numeroSemaine
        nbSemainesConsommees = numeroSemaine

        for (i = 0; i < nbLignes; i++) {
            document.write('<div class="numLigne">' + numDepartLigne + '</div>');
            if (i === 0) {
                for (let x = 0; x < nbSemaineRestantes; x++) {
                    document.write('<div class="restantPourRetraite"></div>')
                }
                for (let y = 0; y < nbSemainesConsommees; y++) {
                    document.write('<div class="consomme"></div>')
                }
            } else {
                for (x = 0; x < 52; x++) {
                    document.write('<div class="' + type + '"></div>')
                }
            }

            document.write('<br>')
            numDepartLigne++;
        }

    } else {
        for (i = 0; i < nbLignes; i++) {
            document.write('<div class="numLigne">' + numDepartLigne + '</div>');

            for (x = 0; x < 52; x++) {
                document.write('<div class="' + type + '"></div>')
            }
            document.write('<br>')
            numDepartLigne++;
        }
    }

}

function dessineMementoMori(ageActuel, ageRetraite, esperanceVie) {
    let premiereSection = esperanceVie - ageRetraite;
    let deuxiemeSection = ageRetraite - ageActuel;
    let troisiemeSection = ageActuel;

    dessineLignes(premiereSection, 1, "restantApresRetraite")
    dessineLignes(deuxiemeSection, premiereSection + 1, "restantPourRetraite")
    dessineLignes(troisiemeSection, troisiemeSection + 1, "consomme")
}