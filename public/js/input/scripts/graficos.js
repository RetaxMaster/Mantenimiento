$(document).ready(function(){

    function updateChart(dataMantenimientos, dataPorVencer) {
        Highcharts.chart('mantenimientos', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: dataMantenimientos
            }]
        });

        Highcharts.chart('porVencer', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: dataPorVencer
            }]
        });
    }


    function getChartData(sucursal) {
        loading(true, "Buscando información...")
        var data = {
            _token: $("meta[name='csrf-token']").attr("content"),
            sucursal: sucursal
        }

        $.post(route("getChartData").url(), data, function(res) {
            res = JSON.parse(res);

            var total = res.total;
            var realizados = (res.realizados * 100) / total;
            var vencidos = (res.vencidos * 100) / total;
            var porVencer = (res.porVencer * 100) / total;
            var pendientes = (res.pendientes * 100) / total;

            var dataMantenimientos = [
                {
                    name: 'Realizados (' + res.realizados + ')',
                    y: realizados,
                    sliced: true,
                    selected: true
                },
                {
                    name: "Vencidos (" + res.vencidos + ")",
                    y: vencidos
                },
                {
                    name: "Pendientes (" + res.pendientes + ")",
                    y: pendientes
                }
            ];

            var dataPorVencer = [
                {
                    name: 'Resto de artículos (' + (total - res.porVencer) + ')',
                    y: (100 - porVencer),
                    sliced: true,
                    selected: true
                },
                {
                    name: "Artículos con mantenimiento por vencer (" + res.porVencer + ")",
                    y: porVencer
                }
            ];

            loading(false);

            updateChart(dataMantenimientos, dataPorVencer);

        }).fail(function(msg) {
            loading(false);
            console.log(msg.responseText);
        });
    }

    getChartData(0);

    // Al seleccioanr unam sucursal
    
    $("#sucursales-mantenimiento").on("change", function() {
        getChartData(this.value);
    });
    
    // -> Al seleccioanr unam sucursal

});