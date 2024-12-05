<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include '../templates/header.php';
?>
<h1>Добавить новый рецепт</h1>
<form action="add_recipe_handler.php" method="POST" enctype="multipart/form-data">
    <label for="name">Название рецепта:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="ingredients">Ингредиенты:</label><br>
    <textarea id="ingredients" name="ingredients" rows="5" required></textarea><br><br>

    <label for="instructions">Шаги приготовления:</label><br>
    <textarea id="instructions" name="instructions" rows="8" required></textarea><br><br>

    <label for="image">Изображение:</label><br>
    <input type="file" id="image" name="image" accept="image/*"><br><br>

    <button type="submit">Добавить рецепт</button>
</form>
<?php

include '../templates/footer.php';