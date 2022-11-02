<?php
echo "ジャンケンを開始します" . PHP_EOL;
play_game();

function play_game(){
  echo "あなたの出す手を「グー」「チョキ」「パー」から選んで入力してください" . PHP_EOL;
  $player = trim(fgets(STDIN));
  $is_valid = validation($player);
  if($is_valid === false){
    echo "入力値が正しくありません。再度入力してください。" . PHP_EOL;
    return play_game();
  }
  $opponent = get_hand();
  echo "対戦相手は「${opponent}」です" . PHP_EOL;
  if($player === $opponent){
    echo "あいこです。もう一度ジャンケンします。" . PHP_EOL;
    return play_game();
  }
  $winner = judge_winner($player, $opponent);
  if($winner === $player){
    echo "あなたの勝ちです！";
  }
  if($winner === $opponent){
    echo "あなたの負けです";
  }
}

function validation(string $hand): bool{
  $choice = ["グー", "チョキ", "パー"];
  $is_valid = true;
  // 空チェック
  if(empty($choice)){
    $is_valid = false;
  }
  // 入力値チェック
  if(!in_array($hand, $choice, true)){
    $is_valid = false;
  }
  return $is_valid;
}

function get_hand(): string{
  $hand = ["グー", "チョキ", "パー"];
  $index = rand(0, 2);
  return $hand[$index];
}

function judge_winner(string $player, string $opponent){
  switch($player){
    case "グー":
      $winner = ($opponent === "チョキ") ? $player : $opponent;
      break;
    case "チョキ":
      $winner = ($opponent === "パー") ? $player : $opponent;
      break;
    case "パー":
      $winner = ($opponent === "グー") ? $player : $opponent;
      break;    
  }
  return $winner;
}

echo "\n";
?>