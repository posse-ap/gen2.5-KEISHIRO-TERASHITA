const main = document.getElementById('main')

const choiceList = [
  ['たかなわ','こうわ','たかわ'],
  ['かめいど','かめど','かめと'],
  ['こうじまち','かゆまち','おかとまち'],
  ['おなりもん','おかどもん','ごせいもん'],
  ['とどろき','たたりき','たたら'],
  ['しゃくじい','せきこうい','いじい'],
  ['ぞうしき','ざっしき','ざっしょく'],
  ['おかちまち','みとちょう','ごしろちょう'],
  ['ししぼね','しこね','ろっこつ'],
  ['こぐれ','こばく','こしゃく']
];

//選択肢をクリックしたときの処理
function buttonClick(questionNumber,chosenNumber,collectNumber){
  const a_Box = document.getElementById(`answerBox_${questionNumber}`);
  const w_Box = document.getElementById(`wrongBox_${questionNumber}`);
  const collectChoice = document.getElementById(`choice${questionNumber}_${collectNumber}`);

  //正解を選ぶと解答Box(正解)を表示
  if(chosenNumber === collectNumber){
    a_Box.className = ('answerBoxAfter');

  //不正解を選ぶと選んだ選択肢が変化し、解答Box(不正解)を表示
  }else{
    const chosenWrong = document.getElementById(`choice${questionNumber}_${chosenNumber}`);
    chosenWrong.classList.add('chosenWrong')
    w_Box.className = ('wrongBoxAfter');
  }

  //正解の選択肢が変化
  collectChoice.classList.add('collectChoice');

  //といた問題の選択肢がクリックできなくなる
  for(let k = 0; k < 3; k++){
    const cannotClick = document.getElementById(`choice${questionNumber}_${k}`);
    cannotClick.classList.add('oneClick')
  }
}

//コンテンツを表示
for(let i = 0; i<choiceList.length; i++){

  //"x.この地名はなんと読む？"を表示
  const newQuestion = document.createElement('h2');
  newQuestion.innerHTML = `${i + 1}.この地名はなんと読む？`;
  newQuestion.className = ('title');
  main.appendChild(newQuestion);

  //問題画像を表示
  const questionPicture = document.createElement('img');
  questionPicture.src = `img/kuizy_${i}.png`;
  questionPicture.className = ('questionPicture');
  main.appendChild(questionPicture);

  //選択肢Boxを作成
  const choiceBoxes = document.createElement('div');
  choiceBoxes.className = ('choiceBox');
  main.appendChild(choiceBoxes);

  //0,1,2のランダムな並びを生成
  const shuffleOrder=[0,1,2];
  for(let l=2; l>0; l--){
    const r = Math.floor(Math.random() * (l + 1));
    const tmp = shuffleOrder[l];
    shuffleOrder[l] = shuffleOrder[r];
    shuffleOrder[r] = tmp;
  }

  //選択肢を作成、shuffleOrderを元に並べて選択肢Boxに追加
  for(let j=0; j<3; j++){
    const createChoice = document.createElement('div');
    createChoice.innerHTML = choiceList[i][shuffleOrder[j]];
    createChoice.classList.add('choice');
    createChoice.id=(`choice${i}_${shuffleOrder[j]}`);
    createChoice.setAttribute('onclick',`buttonClick(${i},${shuffleOrder[j]},0)`);
    choiceBoxes.appendChild(createChoice);
  }

//回答BOX（正解、不正解）を追加
  const answerBox = document.createElement('div');
  answerBox.className = ('answerBox');
  answerBox.id = (`answerBox_${i}`);
  const wrongBox = document.createElement('div');
  wrongBox.className = ('wrongBox');
  wrongBox.id = (`wrongBox_${i}`);

  const collect = document.createElement('p');
  collect.className = ('collect')
  collect.innerHTML = '正解！';
  const message_collect = document.createElement('p');
  message_collect.innerHTML = `正解は` + choiceList[i][0] + 'です！';

  const wrong = document.createElement('p');
  wrong.className = ('wrong')
  wrong.innerHTML = '不正解！';
  const message_wrong = document.createElement('p');
  message_wrong.innerHTML = `正解は` + choiceList[i][0] + 'です！';

  answerBox.appendChild(collect);
  answerBox.appendChild(message_collect);

  wrongBox.appendChild(wrong);
  wrongBox.appendChild(message_wrong);

  main.appendChild(answerBox);
  main.appendChild(wrongBox);
}
