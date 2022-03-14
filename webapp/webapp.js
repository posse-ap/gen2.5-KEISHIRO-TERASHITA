function drawColumnChart() {
  const target = document.getElementById("columnChart");
  const options = {};
  const chart = new google.visualization.ColumnChart(target);
  const data = google.visualization.arrayToDataTable([
    ["date", "hour"],
    ["1", 2],
    ["2", 0],
    ["3", 3],
    ["4", 0],
    ["5", 4],
    ["6", 5],
    ["7", 8],
    ["8", 8],
    ["9", 1],
    ["10", 0],
    ["11", 8],
    ["12", 0],
    ["13", 8],
    ["14", 2],
    ["15", 3],
    ["16", 6],
    ["17", 0],
    ["18", 7],
    ["19", 5],
    ["20", 0],
    ["21", 1],
    ["22", 1],
    ["23", 3],
    ["24", 8],
    ["25", 4],
    ["26", 5],
    ["27", 6],
    ["28", 2],
    ["29", 0],
    ["30", 1],
    ["31", 2],
  ]);
  chart.draw(data, options);
}

function drawPieChart_language() {
  const target = document.getElementById("pieChart_language");
  const options = {
    title: "学習言語",
  };
  const chart = new google.visualization.PieChart(target);
  const data = new google.visualization.arrayToDataTable([
    ["language", "Votes"],
    ["PHP", 100],
    ["Ruby", 20],
    ["Python", 10],
    ["js", 200],
  ]);
  chart.draw(data, options);
}

function drawPieChart_contents() {
  const target = document.getElementById("pieChart_contents");
  const options = {
    title: "学習コンテンツ",
  };
  const chart = new google.visualization.PieChart(target);
  const data = new google.visualization.arrayToDataTable([
    ["language", "Votes"],
    ["PHP", 100],
    ["Ruby", 20],
    ["Python", 10],
    ["js", 200],
  ]);
  chart.draw(data, options);
}

google.charts.load("current", { packages: ["corechart"] });

google.charts.setOnLoadCallback(drawColumnChart);
google.charts.setOnLoadCallback(drawPieChart_language);
google.charts.setOnLoadCallback(drawPieChart_contents);

const modal = document.querySelector("#modal");
const modalClose = document.querySelector("#modalClose");
function showModal() {
  modal.style.display = "block";
}

modalClose.addEventListener("click", closeModal);
function closeModal() {
  modal.style.display = "none";
}
addEventListener("click", outsideClose);
function outsideClose(e) {
  if (e.target === modal) {
    modal.style.display = "none";
  }
}

// カレンダー作る
const calendarHead = document.getElementById("calendarHead");
let monthCounter = 0;
const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
const today = new Date();
let year = today.getFullYear();
const year_now = today.getFullYear();
let month = today.getMonth();
const month_now = today.getMonth();
const date_today = today.getDate();

const date = document.getElementById("date");
date.value = year + "年 " + (month + 1) + "月 " + date_today + "日";

const calendar = document.getElementById("calendar");
const calendarArea = document.getElementById("calendarArea");

for (let i = 0; i < 7; i++) {
  const dayCell = document.createElement("div");
  dayCell.className = "cells_day";
  dayCell.innerHTML = days[i];
  calendarArea.appendChild(dayCell);
}

function choseCell(i,j){
  const chosen = document.querySelector(".chosen");
  const chosenCell = document.getElementById(`${i}_${j}`)
  if(chosen !== null){
    chosen.classList.remove("chosen");
  }
  chosenCell.classList.add("chosen");
  date.value = year + "年 " + (month + 1) + "月 " + chosenCell.innerHTML + "日";
}

for (let i = 0; i < 6; i++) {
  for (let j = 0; j < 7; j++) {
    const cell = document.createElement("div");
    cell.className = "cells";
    cell.id = `${i}_${j}`;
    cell.setAttribute("onclick", `choseCell(${i},${j})`);
    calendarArea.appendChild(cell);
  }
}

const cells = document.querySelectorAll(".cells");

function showDate(){
  const dayOf1st = new Date(year, month, 1).getDay();
  const lastDate = new Date(year, month + 1, 0).getDate();
  let blank = true;
  let counter = 1;
  cells.forEach(function(element){
    if(blank){
      if(element.id === `0_${dayOf1st}`){
        blank = false;
        element.innerHTML = `${counter}`;
        if(date_today === 1){
          element.className = "cells";
          element.classList.add("today");
          element.classList.add("chosen");
        }else{
          element.className = "cells";
          element.classList.add("past");
          if(monthCounter > 0){
            element.className = "cells";
            element.classList.add("future");
          }
        }
        counter++;
      }else{
        element.innerHTML = "";
      }
    }else{
      element.innerHTML = `${counter}`;
      if (counter >= lastDate){
        blank = true;
      }
      if(monthCounter < 0){
        element.className = ("cells");
        element.classList.add("past");
      }else if(monthCounter > 0){
        element.className = ("cells");
        element.classList.add("future");
      }else{
        if(counter < date_today){
          element.className = ("cells")
          element.classList.add("past");
        }else if(counter === date_today){
          element.className = ("cells")
          element.classList.add("today");
          element.classList.add("chosen");
        }else{
          element.className = ("cells")
          element.classList.add("future");
        }
      }
      counter++;
    }
    if(element.innerHTML === ""){
      element.className = "cells_empty";
    }
  });
  calendarHead.innerHTML = year + "年　" + (month+1) + "月";
}

function prev(){
  monthCounter--;
  // year, monthの調整
  if(month === 0){
    month = 11;
    year--;
  }else{
    month--;
  }

  // カレンダーの再表示
  showDate();
}

function next(){
  monthCounter++;
  //year, monthの調整
  if(month === 11){
    month = 0;
    year++;
  }else{
    month++;
  }

  // カレンダーの再表示
  showDate();
}

const calendarBackGround = document.getElementById("calendarBackGround");

function showCalendar(){
  calendarBackGround.style.display = "block";
  showDate();
}

addEventListener("click", closeCalendar);
function closeCalendar(e){
  if (e.target === calendarBackGround) {
    calendarBackGround.style.display = "none";
  }
}