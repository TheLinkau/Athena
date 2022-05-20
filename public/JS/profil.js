
for (let canva of document.getElementsByTagName('canvas')) {
    var score = Number(canva.dataset.score)
    var maxscore = Number(canva.dataset.maxscore)
    new Chart(canva.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels : ["succes", "echec"],
            datasets: [{
                data: [Number(canva.dataset.score), maxscore - Number(canva.dataset.score)],
                backgroundColor: ["#46BFBD", "#F7464A"],
                hoverBackgroundColor: ["#5AD3D1", "#FF5A5E"]
            }]
        },
        options: {
            responsive: false,
            legend : {
                display : false
            }

        }
    })
}