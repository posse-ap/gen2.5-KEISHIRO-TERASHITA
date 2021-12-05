let answer_1 = document.getElementById('choiceList0_0');

let answerBox = document.getElementById('appear');

let wrong1_2 = document.getElementById('choiceList0_1');

let wrongBox1 = document.getElementById('wrongBox1');

let wrong1_3 = document.getElementById('choiceList0_2');

// function buttonClick_right(){
//   answer_1.classList.add('chosenAnswer')

//   answerBox.className=('appeared')

//   wrong1_2.classList.add('oneClick')
//   wrong1_3.classList.add('oneClick')
// }

// function buttonClick_wrong1_2(){
//   wrong1_2.classList.add('chosenWrong')
//   wrongBox1.className=('appeared')
//   answer_1.classList.add('oneClick')
//   wrong1_3.classList.add('oneClick')
//   answer_1.classList.add('chosenAnswer')
// }

// function buttonClick_wrong1_3(){
//   wrong1_3.classList.add('chosenWrong')
//   wrongBox1.className=('appeared')
//   answer_1.classList.add('oneClick')
//   wrong1_2.classList.add('oneClick')
//   answer_1.classList.add('chosenAnswer')
// }

function buttonClick(questionNumber,chosenNumber,collectNumber){
  let chosenWrong = document.getElementById(`choiceList0_${chosenNumber}`)
  if(chosenNumber === collectNumber){
    answerBox.className=('appeared')
  }else{
    wrongBox1.className=('appeared')
    chosenWrong.classList.add('chosenWrong')
  }

  console.log(chosenNumber)
  answer_1.classList.add('chosenAnswer')
  answer_1.classList.add('oneClick')
  wrong1_2.classList.add('oneClick')
  wrong1_3.classList.add('oneClick')
}