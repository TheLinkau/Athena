const stringArray = document.getElementById('init').dataset.questions.split('|')

// Compteurs
const nbQuestions = (stringArray.length - 1) / 6
var currentQuestion = 1

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

// Initialisation
document.getElementById('contenu').innerHTML = stringArray[contenu]
document.getElementById('r1').innerHTML = stringArray[r1]
document.getElementById('r2').innerHTML = stringArray[r2]
document.getElementById('r3').innerHTML = stringArray[r3]
document.getElementById('r4').innerHTML = stringArray[r4]

// Appelée quand on clique sur une réponse
function nextQuestion(resultat) {
    // Vérification réponse
    if (Number(resultat) == stringArray[answer]) {
        score += 1
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
        contenuDom.style.transform = "translate(0px,-50vh)"
        r1Dom.style.transform = "translate(-200%,0px)"
        r3Dom.style.transform = "translate(-200%,0px)"
        r2Dom.style.transform = "translate(200%,0px)"
        r4Dom.style.transform = "translate(200%,0px)"
        // Chargement des éléments de la question suivante (mettre le timeout au temps de l'animation)
        setTimeout(() => {
                contenu += 6
                r1 += 6
                r2 += 6
                r3 += 6
                r4 += 6
                answer += 6
                updateItems()
                // Ramener les items dans la vue
                contenuDom.style.transform = "translate(0px,0px)"
                r1Dom.style.transform = "translate(0px,0px)"
                r3Dom.style.transform = "translate(0px,0px)"
                r2Dom.style.transform = "translate(0px,0px)"
                r4Dom.style.transform = "translate(0px,0px)"
            }
            ,1000
        )
    }
}

// Quiz finit
function done() {
    console.log('TO-DO : Envoi du resultat en BDO')
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