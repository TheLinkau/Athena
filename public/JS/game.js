const stringArray = document.getElementById('init').dataset.questions.split('|')

// Compteurs
const nbQuestions = (stringArray.length - 1) / 6
var currentQuestion = 1
setCompteur(1)

// Score
var score = 0

// Index
var contenu = 0
var r1 = 1
var r2 = 2
var r3 = 3
var r4 = 4
var answer = 5

// BufferDOM
var contenuDom = null
var r1Dom = null
var r2Dom = null
var r3Dom = null
var r4Dom = null

// END
var end = false

// Initialisation
document.getElementById('contenu').innerHTML = stringArray[contenu]
document.getElementById('r1').innerHTML = stringArray[r1]
document.getElementById('r2').innerHTML = stringArray[r2]
document.getElementById('r3').innerHTML = stringArray[r3]
document.getElementById('r4').innerHTML = stringArray[r4]

// Appelée quand on clique sur une réponse
function nextQuestion(resultat) {
    // Vérification réponse
    var rep = document.getElementById('r' + String(resultat))
    var temp = document.getElementById('contenu')
    const backColor = rep.style.backgroundColor
    const backColor2 = temp.style.backgroundColor
    if (Number(resultat-1) == stringArray[answer]) {
        score += 1
        document.getElementById('okcounter').innerHTML = 'Correct answers : ' + String(score)
        rep.style.backgroundColor = 'green'
        temp.style.backgroundColor = 'green'
    } else {
        rep.style.backgroundColor = 'red'
        temp.style.backgroundColor = 'red'
    }
    // Faire un code qui change la couleur de la réponse en fonction de si on a bon ou non

    // Si quizz fini
    if (currentQuestion == nbQuestions) {
        done()
    } else {
        currentQuestion += 1
        // Load DOM pour animations
        contenuDom = document.getElementById('contenu')
        r1Dom = document.getElementById('r1')
        r2Dom = document.getElementById('r2')
        r3Dom = document.getElementById('r3')
        r4Dom = document.getElementById('r4')
        // Faire sortir les items de la vue
        setTimeout(() => {
                contenuDom.style.transform = "translate(0px,-50vh)"
                r1Dom.style.transform = "translate(-200%,0px)"
                r3Dom.style.transform = "translate(-200%,0px)"
                r2Dom.style.transform = "translate(200%,0px)"
                r4Dom.style.transform = "translate(200%,0px)"
            }
            , 1000
        )
        // Chargement des éléments de la question suivante (mettre le timeout au temps de l'animation)
        setTimeout(() => {
                contenu += 6
                r1 += 6
                r2 += 6
                r3 += 6
                r4 += 6
                answer += 6
                updateItems()
                setCompteur(currentQuestion)
                rep.style.backgroundColor = backColor
                contenuDom.style.backgroundColor = backColor2
                // Ramener les items dans la vue
                contenuDom.style.transform = "translate(0px,0px)"
                r1Dom.style.transform = "translate(0px,0px)"
                r3Dom.style.transform = "translate(0px,0px)"
                r2Dom.style.transform = "translate(0px,0px)"
                r4Dom.style.transform = "translate(0px,0px)"
            }
            , 2000
        )
    }
}

// Quiz finit
function done() {
    if (!end) {
        // TO DO TO DO TO DO TO DO TO DO
        console.log('TO-DO : Envoi du resultat en BDO')
        end = true // pour empecher d'envoyer plus d'une fois le résultat
    }
    // Redirection vers l'accueil
    setTimeout(() => {
        // Redirection
    }, 3000)
}

function updateItems() {
    contenuDom.innerHTML = stringArray[contenu]
    r1Dom.innerHTML = stringArray[r1]
    r2Dom.innerHTML = stringArray[r2]
    r3Dom.innerHTML = stringArray[r3]
    r4Dom.innerHTML = stringArray[r4]
}

function wait(ms) {
    var start = new Date().getTime();
    var end = start;
    while (end < start + ms) {
        end = new Date().getTime();
    }
}

function setCompteur(int) {
    document.getElementById('compteur').innerHTML = "Question " + String(int) + " / " + String(nbQuestions)
}