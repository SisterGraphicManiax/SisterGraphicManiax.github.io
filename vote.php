<?php
// フォームから送信されたデータを受け取る
$name = $_POST['name'];
$age = $_POST['age'];
$candidate = $_POST['candidate'];

// データベースに接続する
$dsn = 'mysql:host=localhost;dbname=mydatabase';
$username = 'myusername';
$password = 'mypassword';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// データをデータベースに保存する
$sql = "INSERT INTO votes (name, age, candidate) VALUES (:name, :age, :candidate)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':age', $age);
$stmt->bindParam(':candidate', $candidate);
$stmt->execute();

// 投票結果を表示する
echo "投票が完了しました。ありがとうございました。";
?>
