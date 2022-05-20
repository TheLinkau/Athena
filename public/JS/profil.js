
for (let canva of document.getElementsByTagName('canvas')) {
    var maxscore = Number(canva.dataset.score)
    new Chart(canva.getContext('2d'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [Number(canva.dataset.score), 40 - Number(canva.dataset.score)],
                backgroundColor: ["#46BFBD", "#F7464A"],
                hoverBackgroundColor: ["#5AD3D1", "#FF5A5E"]
            }]
        },
        options: {
            responsive: false,
        }
    })
}