
// モーダル
const modal = document.querySelector("#modal");
const modalClose = document.querySelector("#modalClose");
function showModal() {
  modal.style.display = "block";
}

modalClose.addEventListener("click", closeModal);
function closeModal() {
  modal.style.display = "none";
  location.reload();
}
addEventListener("click", outsideClose);
function outsideClose(e) {
  if (e.target === modal) {
    modal.style.display = "none";
    location.reload();
  }
}

const link_share = document.getElementById("link_share");
link_share.addEventListener("click", function(event){
  const shareButton = document.getElementById("share");
  if (shareButton.checked){
    const twitterMessage = document.getElementById("twitterMessage");
    link_share.href = `https://twitter.com/intent/tweet?&text=${twitterMessage.value}`;
  }else{
    event.preventDefault();
  }
  formRapper.innerHTML = "";
  document.getElementById("submitButton").style.display = "none";
  const loading_back = document.createElement("div");
  loading_back.id = "loading_back";
  formRapper.appendChild(loading_back);
  const loading_front = document.createElement("div");
  loading_front.id = "loading_front";
  loading_back.appendChild(loading_front);
  setTimeout(done, 2500);
});

function done(){
  formRapper.innerHTML = "";
  const completeMessage = document.createElement("div");
  completeMessage.id = "completeMessage";
  const awesome = document.createElement("p");
  awesome.id = "awesome";
  awesome.innerHTML = "AWESOME!";
  completeMessage.appendChild(awesome);
  const mark = document.createElement("div");
  mark.id = "mark";
  completeMessage.appendChild(mark);
  const message = document.createElement("div");
  message.id = "message_done";
  message.innerHTML = "記録、投稿<br>完了しました";
  completeMessage.appendChild(message);
  formRapper.appendChild(completeMessage);
}

// カレンダー作る
const calendarHead = document.getElementById("calendarHead");
let monthCounter = 0;
const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const today = new Date();
let year = today.getFullYear();
let year_chosen = today.getFullYear();
const year_now = today.getFullYear();

let month = today.getMonth();
const month_now = today.getMonth();
let month_chosen = today.getMonth();

const date_today = today.getDate();
let date_chosen = today.getDate();

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

function choseCell(i, j) {
  const chosen = document.querySelector(".chosen");
  const chosenCell = document.getElementById(`${i}_${j}`);
  if (chosen) {
    chosen.classList.remove("chosen");
  }
  chosenCell.classList.add("chosen");

  year_chosen = year;
  month_chosen = month;
  date_chosen = Number(chosenCell.innerHTML);
}

function getValueOfDate(){
  date.value = year_chosen + "年 " + (month_chosen + 1) + "月 " + date_chosen + "日";
  calendarBackGround.style.display = "none";
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

function showDate() {
  const dayOf1st = new Date(year, month, 1).getDay();
  const lastDate = new Date(year, month + 1, 0).getDate();
  let blank = true;
  let counter = 1;
  cells.forEach(function (element) {
    if (blank) {
      if (element.id === `0_${dayOf1st}`) {
        blank = false;
        element.innerHTML = `${counter}`;
        if (date_today === 1) {
          element.className = "cells";
          element.classList.add("today");
        } else {
          element.className = "cells";
          element.classList.add("past");
        }
        counter++;
      } else {
        element.innerHTML = "";
      }
    } else {
      element.innerHTML = `${counter}`;
      if (counter >= lastDate) {
        blank = true;
      }
      if (monthCounter < 0) {
        element.className = "cells";
        element.classList.add("past");
      } else if (monthCounter > 0) {
        element.className = "cells";
        element.classList.add("future");
      } else {
        if (counter < date_today) {
          element.className = "cells";
          element.classList.add("past");
        } else if (counter === date_today) {
          element.className = "cells";
          element.classList.add("today");
        } else {
          element.className = "cells";
          element.classList.add("future");
        }
      }
      counter++;
    }
    if (year === year_chosen && month === month_chosen && element.innerHTML === `${date_chosen}`) {
      element.classList.add("chosen");
    }
    if (element.innerHTML === "") {
      element.className = "cells_empty";
    }
  });
  calendarHead.innerHTML = year + "年　" + (month + 1) + "月";
}

function prev() {
  monthCounter--;
  // year, monthの調整
  if (month === 0) {
    month = 11;
    year--;
  } else {
    month--;
  }

  // カレンダーの再表示
  showDate();
}

function next() {
  monthCounter++;
  //year, monthの調整
  if (month === 11) {
    month = 0;
    year++;
  } else {
    month++;
  }

  // カレンダーの再表示
  showDate();
}

const calendarBackGround = document.getElementById("calendarBackGround");

function showCalendar() {
  calendarBackGround.style.display = "block";
}

addEventListener("click", closeCalendar);
function closeCalendar(e) {
  if (e.target === calendarBackGround) {
    calendarBackGround.style.display = "none";
  }
}

window.onload = showDate();

// チェックボックスクリック時の色
const checkbox = document.querySelectorAll(".checkbox");
const checkbox_label = document.querySelectorAll("label");

function checkboxClick(index) {
  if (checkbox[index]) {
    checkbox[index].classList.toggle("checkbox_chosen");
  }
}

checkbox_label.forEach((element, index) =>
  element.setAttribute("onclick", `checkboxClick(${index})`)
);
