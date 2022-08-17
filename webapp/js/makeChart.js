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
    ["", 2],
    ["2", 0],
    ["", 3],
    ["4", 0],
    ["", 4],
    ["6", 5],
    ["", 8],
    ["8", 8],
    ["", 1],
    ["10", 0],
    ["", 8],
    ["12", 0],
    ["", 8],
    ["14", 2],
    ["", 3],
    ["16", 6],
    ["", 0],
    ["18", 7],
    ["", 5],
    ["20", 0],
    ["", 1],
    ["22", 1],
    ["", 3],
    ["24", 8],
    ["", 4],
    ["26", 5],
    ["", 6],
    ["28", 2],
    ["", 0],
    ["30", 1],
    ["", 2],
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
    ["JavaScript", 10],
    ["CSS", 20],
    ["PHP", 10],
    ["HTML", 2],
    ["Laravel", 11],
    ["SQL", 5],
    ["SHELL", 7],
    ["情報システム基礎知識(その他)", 8],
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
    ["language", "Votes"],
    ["ドットインストール", 40],
    ["N予備校", 20],
    ["POSSE課題", 10]
  ]);
  chart.draw(data, options);
}

google.charts.load("current", { packages: ["corechart"] });

google.charts.setOnLoadCallback(drawColumnChart);
google.charts.setOnLoadCallback(drawPieChart_language);
google.charts.setOnLoadCallback(drawPieChart_contents);
