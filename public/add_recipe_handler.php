<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $name = htmlspecialchars(trim($_POST['name']));
    $ingredients = htmlspecialchars(trim($_POST['ingredients']));
    $instructions = htmlspecialchars(trim($_POST['instructions']));
    $image = null;

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($image_type, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $target_file;
            }
        }
    }
    try {
        $query = $pdo->prepare(
            "INSERT INTO recipes (user_id, name, ingredients, instructions, image) 
            VALUES (:user_id, :name, :ingredients, :instructions, :image)"
        );
        $query->execute([
            'user_id' => $user_id,
            'name' => $name,
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            'image' => $image
        ]);

        header('Location: account.php');
        exit;
    } catch (PDOException $e) {
        die("Ошибка: " . $e->getMessage());
    }
}
?>
