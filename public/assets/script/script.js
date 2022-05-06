const data = {
    labels: [
        'Alcool',
        'Food',
        'Divers'
    ],
    datasets: [{
        label: 'Budget',
        data: [300, 50, 100],
        backgroundColor: [
            'rgb(152, 107, 22)',
            'rgb(1, 30, 42)',
            'rgb(219, 169, 0)'
        ],
        hoverOffset: 4
    }]
};

const config = {
    type: 'pie',
    data: data,
    options: {
        //responsive: false,
        plugins: {
            legend: {
                display: false,
            }
        }
    }

};


