var maxscore = Number(document.getElementById('res').dataset.score)

for (let canva of document.getElementsByTagName('canvas')) {
    new Chart(canva.getContext('2d'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [Number(canva.dataset.score), maxscore - Number(canva.dataset.score)],
                backgroundColor: ["#46BFBD", "#F7464A"],
                hoverBackgroundColor: ["#5AD3D1", "#FF5A5E"]
            }]
        },
        options: {
            responsive: false,
        }
    })
}