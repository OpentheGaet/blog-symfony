$(document).ready(function () {

    $('#menu-hide').on('click', toogleHide);
    $('#menu-show').on('click', toogleShow);

    function toogleHide() {
      $("#sidebar-wrapper").animate({ width: 'toggle' });
      $('.col-md-9').attr("class", "col-md-12 card").css({ 'transition' : '1s' });
      $('#menu-hide').hide();
      $('#menu-show').show();
      return;
    }

    function toogleShow() {
      $("#sidebar-wrapper").animate({ width: 'toggle' });
      $('.col-md-12').attr("class", "col-md-9 card").css({ 'transition' : '0s' });
      $('#menu-show').hide();
      $('#menu-hide').show();
      return;
    }

    // Load google charts
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 10],
            ['Eat', 2],
            ['TV', 2],
            ['Gym', 2],
            ['Sleep', 8]
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = { 'title': 'My Average Day', 'width': 550, 'height': 350 };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');
      data.addColumn('number', 'Energy Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1, .25],
        [{v: [9, 0, 0], f: '9 am'}, 2, .5],
        [{v: [10, 0, 0], f:'10 am'}, 3, 1],
        [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
        [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
        [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
        [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
        [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
        [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
        [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
      ]);

      var options = { 'title': 'My Average Day', 'width': 550, 'height': 350 }

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
});

