const choiceList = [
  ["たかなわ" , "こうわ" , "たかわ"],
  ["かめいど" , "かめと" , "かめど"],
  ["こうじまち" , "おかとまち" , "かゆまち"]
];

const main = document.querySelector("#main");

function createQuestion(questionNumber){
  const questionArea = document.createElement("section");
  questionArea.className = "questionArea";
  questionArea.id = `question_${questionNumber + 1}`;

  const questionTitle = document.createElement("p");
  questionTitle.innerHTML = `${questionNumber + 1}. この地名はなんて読む？`;
  questionTitle.className = "questionTitle"
  questionArea.appendChild(questionTitle);

  const questionImg = document.createElement("img");
  questionImg.src = `./img/kuizy-${questionNumber + 1}.png`;
  questionImg.className = "questionImg";
  questionArea.appendChild(questionImg);

  const random = [0 , 1 , 2];
  for(let i = 2; i > 0; i--){
    let r = Math.floor(Math.random()*(i + 1));
    let tmp = random[i];
    random[i] = random[r];
    random[r] = tmp;
  }
  const choiceArea = document.createElement("ul");
  choiceArea.className = "choiceArea";
  choiceArea.id = `choiceArea_${questionNumber}`;
  for(i = 0; i < 3; i++){
    const choice = document.createElement("li");
    choice.innerHTML = choiceList[questionNumber][random[i]];
    choice.className = "choice";
    choice.id = `choice_${questionNumber}_${random[i]}`;
    choice.setAttribute("onclick" , `choiceClick(${questionNumber} , ${random[i]} , 0)`);
    choiceArea.appendChild(choice);
  }
  questionArea.appendChild(choiceArea);

  const answerBox = document.createElement("div");
  answerBox.className = "answerBox_hidden";
  answerBox.id = `answerBox_${questionNumber}`;
  const result = document.createElement("p");
  result.innerHTML = "";
  result.id = `result_${questionNumber}`;
  const answerMessage = document.createElement("p");
  answerMessage.innerHTML = "正解は「" + choiceList[questionNumber][0] + "」です！";
  answerBox.appendChild(result);
  answerBox.appendChild(answerMessage);
  questionArea.appendChild(answerBox);


  main.appendChild(questionArea);
}

function choiceClick(questionNumber , chosenNumber , correctNumber){
  const chosen = document.getElementById(`choice_${questionNumber}_${chosenNumber}`);
  const correct = document.getElementById(`choice_${questionNumber}_${correctNumber}`);
  chosen.className = "wrong";
  correct.className = "correct";
  
  const result = document.getElementById(`result_${questionNumber}`);
  if (chosenNumber === correctNumber){
  result.innerHTML = "正解！"
  result.className = "correctResult"
} else {
    result.innerHTML = "不正解！"
    result.className = "wrongResult"
  }
  const choiceArea = document.getElementById(`choiceArea_${questionNumber}`);
  choiceArea.className = "chosenArea";
  document.querySelector(`#answerBox_${questionNumber}`).className = "answerBox_shown";
}

for(let quizCounter = 0; quizCounter < choiceList.length; quizCounter++){
  createQuestion(quizCounter);
}