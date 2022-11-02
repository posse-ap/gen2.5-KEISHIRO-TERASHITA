<?php
  $data = $hours_each_day;
  $y_m = (string)$requested['shown_year'] . '-' . num_to_str($requested['shown_month']);
?>

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>

function drawColumnChart() {
  const target = document.getElementById("columnChart");
  const options = {
    "chartArea" : {"width" : "90%" , "height" : "80%"},
    padding:0,
    vAxis: {
      format: "#h",
      ticks: [0, 2, 4, 6, 8],
    },
    hAxis: {
      showTextEvery: 1,
      textStyle:{
        fontSize:10
      }
    },
  };
  const chart = new google.visualization.ColumnChart(target);
  const data = google.visualization.arrayToDataTable([
    ["date", "hour"],
    // 棒グラフにデータを挿入
    <?php
    $end_of_date = date('t', strtotime($y_m . '-1'));
    for ($i = 0; $i < $end_of_date; $i++) :
      $label = $i % 2 === 0 ? '' : (string)($i + 1);
      $index_date = $y_m . '-' . num_to_str($i + 1);
    ?>
    ["<?= $label ?>", <?php insert_data($data, $index_date); ?>],
    <?php endfor ?>
  ]);
  chart.draw(data, options);
}

function drawPieChart_language() {
  const target = document.getElementById("pieChart_language");
  const options = {
    pieHole: 0.5,
    legend: "none",
    'chartArea': {'width': '95%', 'height': '95%'},
    slices: {
      0: { color: '#0445ec' },
      1: { color: '#0f70bd' },
      2: { color: '#20bdde' },
      3: { color: '#3ccefe' },
      4: { color: '#b29ef3' },
      5: { color: '#6c46eb' },
      6: { color: '#4a17ef' },
      7: { color: '#3005c0' },
    }
  };
  const chart = new google.visualization.PieChart(target);
  const data = new google.visualization.arrayToDataTable([
    ["language", "hours"],
    <?php foreach ($hours_each_language as $language => $hour) : ?>
    ["<?= $language ?>", <?php insert_data($hours_each_language, $language)?>],
    <?php endforeach ?>
  ]);
  chart.draw(data, options);
}

function drawPieChart_contents() {
  const target = document.getElementById("pieChart_contents");
  const options = {
    pieHole: 0.5,
    legend: "none",
    'chartArea': {'width': '95%', 'height': '95%'},
    slices: {
      0: { color: '#0445ec' },
      1: { color: '#0f70bd' },
      2: { color: '#20bdde' },
      3: { color: '#3ccefe' },
      4: { color: '#b29ef3' },
      5: { color: '#6c46eb' },
      6: { color: '#4a17ef' },
      7: { color: '#3005c0' },
    }
  };
  const chart = new google.visualization.PieChart(target);
  const data = new google.visualization.arrayToDataTable([
    ["content", "Votes"],
    <?php foreach ($hours_each_content as $content => $hour) : ?>
    ["<?= $content ?>", <?php insert_data($hours_each_content, $content)?>],
    <?php endforeach ?>
  ]);
  chart.draw(data, options);
}

google.charts.load("current", { packages: ["corechart"] });

google.charts.setOnLoadCallback(drawColumnChart);
google.charts.setOnLoadCallback(drawPieChart_language);
google.charts.setOnLoadCallback(drawPieChart_contents);

</script>
