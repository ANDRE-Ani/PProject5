// Récupération et affichage de l'heure

var laDate = {
    jours: "",
    mois: "",
    heure: "",
    minute: "",
    seconde: "",
    message: "",

    // Récupère date et heure
    runClock: function() {

        jours = new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
        mois = new Array("janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
        date = new Date();
        laDate.heure = date.getHours();
        if (laDate.heure < 10) {
            laDate.heure = "0" + laDate.heure
        }

        laDate.minute = date.getMinutes();
        if (laDate.minute < 10) {
            laDate.minute = "0" + laDate.minute
        }

        laDate.seconde = date.getSeconds();
        if (laDate.seconde < 10) {
            laDate.seconde = "0" + laDate.seconde
        }

        laDate.message = jours[date.getDay()] + " ";
        laDate.message += date.getDate() + " ";
        laDate.message += mois[date.getMonth()] + " ";
        laDate.message += date.getFullYear();

        document.getElementById("dateJ").innerHTML = "Nous sommes le " + laDate.message + "<br>" + "Il est " + laDate.heure + ':' + laDate.minute + ':' + laDate.seconde;

    }

}

// Interval pour mettre à jour l'heure
timerID = setInterval(laDate.runClock, 1000);