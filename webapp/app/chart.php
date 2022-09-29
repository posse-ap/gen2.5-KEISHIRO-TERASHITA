<?php
  $data = $hours_each_day;
  $Y_m = date("Y-m", strtotime("0 month"));
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
      // textSize:12
    },
  };
  const chart = new google.visualization.ColumnChart(target);
  const data = google.visualization.arrayToDataTable([
    ["date", "hour"],
    ["", <?php insert_data($data, $Y_m . "-01"); ?>],
    ["2", <?php insert_data($data, $Y_m . "-02"); ?>],
    ["", <?php insert_data($data, $Y_m . "-03"); ?>],
    ["4", <?php insert_data($data, $Y_m . "-04"); ?>],
    ["", <?php insert_data($data, $Y_m . "-05"); ?>],
    ["6", <?php insert_data($data, $Y_m . "-06"); ?>],
    ["", <?php insert_data($data, $Y_m . "-07"); ?>],
    ["8", <?php insert_data($data, $Y_m . "-08"); ?>],
    ["", <?php insert_data($data, $Y_m . "-09"); ?>],
    ["10", <?php insert_data($data, $Y_m . "-10"); ?>],
    ["", <?php insert_data($data, $Y_m . "-11"); ?>],
    ["12", <?php insert_data($data, $Y_m . "-12"); ?>],
    ["", <?php insert_data($data, $Y_m . "-13"); ?>],
    ["14", <?php insert_data($data, $Y_m . "-14"); ?>],
    ["", <?php insert_data($data, $Y_m . "-15"); ?>],
    ["16", <?php insert_data($data, $Y_m . "-16"); ?>],
    ["", <?php insert_data($data, $Y_m . "-17"); ?>],
    ["18", <?php insert_data($data, $Y_m . "-18"); ?>],
    ["", <?php insert_data($data, $Y_m . "-19"); ?>],
    ["20", <?php insert_data($data, $Y_m . "-20"); ?>],
    ["", <?php insert_data($data, $Y_m . "-21"); ?>],
    ["22", <?php insert_data($data, $Y_m . "-22"); ?>],
    ["", <?php insert_data($data, $Y_m . "-23"); ?>],
    ["24", <?php insert_data($data, $Y_m . "-24"); ?>],
    ["", <?php insert_data($data, $Y_m . "-25"); ?>],
    ["26", <?php insert_data($data, $Y_m . "-26"); ?>],
    ["", <?php insert_data($data, $Y_m . "-27"); ?>],
    ["28", <?php insert_data($data, $Y_m . "-28"); ?>],
    ["", <?php insert_data($data, $Y_m . "-29"); ?>],
    ["30", <?php insert_data($data, $Y_m . "-30"); ?>],
    ["", <?php insert_data($data, $Y_m . "-31"); ?>],
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
    ["HTML", <?php insert_data($hours_each_language, "HTML") ?>],
    ["CSS", <?php insert_data($hours_each_language, "CSS") ?>],
    ["JS", <?php insert_data($hours_each_language, "JS") ?>],
    ["PHP", <?php insert_data($hours_each_language, "PHP") ?>],
    ["SQL", <?php insert_data($hours_each_language, "SQL") ?>],
    ["Laravel", <?php insert_data($hours_each_language, "Laravel") ?>],
    ["SHELL", <?php insert_data($hours_each_language, "SHELL") ?>],
    ["その他", <?php insert_data($hours_each_language, "その他") ?>],
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
    }
  };
  const chart = new google.visualization.PieChart(target);
  const data = new google.visualization.arrayToDataTable([
    ["content", "Votes"],
    ["POSSE課題", <?php insert_data($hours_each_content, "POSSE課題") ?>],
    ["ドットインストール", <?php insert_data($hours_each_content, "ドットインストール") ?>],
    ["N予備校", <?php insert_data($hours_each_content, "N予備校") ?>],
  ]);
  chart.draw(data, options);
}

google.charts.load("current", { packages: ["corechart"] });

google.charts.setOnLoadCallback(drawColumnChart);
google.charts.setOnLoadCallback(drawPieChart_language);
google.charts.setOnLoadCallback(drawPieChart_contents);

</script>
