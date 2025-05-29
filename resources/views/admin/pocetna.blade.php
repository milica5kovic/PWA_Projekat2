@extends("admin.templates.main")

@section('content')
    <div class="container-fluid mt-4">
        <h2 class="mb-4">Admin Dashboard - Statistika</h2>

        <div class="row">
            <div class="col-lg-10 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Broj Porudžbina Tokom Vremena</h6>
                    </div>
                    <div class="card-body">
                        <div id="porudzbine_chart_div" style="width: 100%; height: 400px;"></div>
                        @if($porudzbineData == '[["Datum","Broj Porud\u017ebina"]]')
                            <p class="text-center mt-3">Nema podataka o porudžbinama za prikaz.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Broj Dodatih Proizvoda Tokom Vremena</h6>
                    </div>
                    <div class="card-body">
                        <div id="proizvodi_chart_div" style="width: 100%; height: 350px;"></div>
                        @if($proizvodiData == '[["Datum","Broj Proizvoda"]]')
                            <p class="text-center mt-3">Nema podataka o proizvodima za prikaz.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info">Broj Dodatih Kategorija Tokom Vremena</h6>
                    </div>
                    <div class="card-body">
                        <div id="kategorije_chart_div" style="width: 100%; height: 350px;"></div>
                        @if($kategorijeData == '[["Datum","Broj Kategorija"]]')
                            <p class="text-center mt-3">Nema podataka o kategorijama za prikaz.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'line']});
        google.charts.setOnLoadCallback(drawAllCharts);

        function drawAllCharts() {
            drawPorudzbineChart();
            drawProizvodiChart();
            drawKategorijeChart();
        }

        function drawPorudzbineChart() {
            const raw = {!! $porudzbineData !!};
            var data = google.visualization.arrayToDataTable(raw);
            if (data.length <= 1) {
                document.getElementById('porudzbine_chart_div').innerHTML = '<p class="text-center p-5">Nema dovoljno podataka o porudžbinama za prikaz grafikona.</p>';
                return;
            }
            var options = {
                title: 'Porudžbine Tokom Vremena',
                curveType: 'function',
                legend: { position: 'bottom' },
                hAxis: { title: 'Datum', format: 'dd.MM.yyyy', slantedText: true, slantedTextAngle: 45 },
                vAxis: { title: 'Broj Porudžbina', minValue: 0, viewWindow: { min:0 } },
                series: { 0: { color: '#1cc88a' } } // Green
            };
            var chart = new google.visualization.LineChart(document.getElementById('porudzbine_chart_div'));
            chart.draw(data, options);
        }

        function drawProizvodiChart() {
            const proizvodiRawData = {!! $proizvodiData !!};
            if (proizvodiRawData.length <= 1) {
                document.getElementById('proizvodi_chart_div').innerHTML = '<p class="text-center p-5">Nema dovoljno podataka o proizvodima za prikaz grafikona.</p>';
                return;
            }
            var data = google.visualization.arrayToDataTable(proizvodiRawData);
            var options = {
                title: 'Dodati Proizvodi Tokom Vremena',
                legend: { position: 'bottom' },
                hAxis: { title: 'Datum', format: 'dd.MM.yyyy', slantedText: true, slantedTextAngle: 45 },
                vAxis: { title: 'Broj Proizvoda', minValue: 0, viewWindow: { min:0 } },
                colors: ['#4e73df'] // Blue
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('proizvodi_chart_div'));
            chart.draw(data, options);
        }

        function drawKategorijeChart() {
            const raw = {!! $kategorijeData !!};
            const kategorijeRawData = raw.map((row, i) => i === 0 ? row : [new Date(row[0]), row[1]]);
            if (kategorijeRawData.length <= 1) {
                document.getElementById('kategorije_chart_div').innerHTML = '<p class="text-center p-5">Nema dovoljno podataka o kategorijama za prikaz grafikona.</p>';
                return;
            }
            var data = google.visualization.arrayToDataTable(kategorijeRawData);
            var options = {
                title: 'Dodate Kategorije Tokom Vremena',
                legend: { position: 'bottom' },
                hAxis: { title: 'Datum', format: 'dd.MM.yyyy', slantedText: true, slantedTextAngle: 45 },
                vAxis: { title: 'Broj Kategorija', minValue: 0, viewWindow: { min:0 } },
                colors: ['#36b9cc']
            };
            var chart = new google.visualization.LineChart(document.getElementById('kategorije_chart_div'));
            chart.draw(data, options);
        }

        var resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(drawAllCharts, 500);
        });
    </script>

