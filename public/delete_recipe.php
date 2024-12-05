<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['recipe_id'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    $recipe_id = (int) $_GET['recipe_id'];
    $user_id = $_SESSION['user_id'];
    try {
        $query = $pdo->prepare("SELECT image FROM recipes WHERE id = :id AND user_id = :user_id");
        $query->execute(['id' => $recipe_id, 'user_id' => $user_id]);
        $recipe = $query->fetch();

        if ($recipe) {
            if ($recipe['image'] && file_exists($recipe['image'])) {
                unlink($recipe['image']);
            }

            $delete_query = $pdo->prepare("DELETE FROM recipes WHERE id = :id AND user_id = :user_id");
            $delete_query->execute(['id' => $recipe_id, 'user_id' => $user_id]);

            header('Location: account.php');
            exit;
        } else {
            die("Рецепт не найден.");
        }
    } catch (PDOException $e) {
        die("Ошибка: " . $e->getMessage());
    }
} else {
    header('Location: account.php');
    exit;
}
