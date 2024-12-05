<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['recipe_id'])) {
    $recipe_id = (int) $_GET['recipe_id'];

    try {
        $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id AND user_id = :user_id");
        $query->execute(['id' => $recipe_id, 'user_id' => $user_id]);
        $recipe = $query->fetch();

        if (!$recipe) {
            die("Рецепт не найден.");
        }
    } catch (PDOException $e) {
        die("Ошибка: " . $e->getMessage());
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipe_id = (int) $_POST['recipe_id'];
    $name = trim($_POST['name']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $old_image = $_POST['old_image'];

    $image = $old_image;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = '../uploads/' . uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image);

        if ($old_image && file_exists($old_image)) {
            unlink($old_image);
        }
    }

    try {
        $update_query = $pdo->prepare("
            UPDATE recipes 
            SET name = :name, ingredients = :ingredients, instructions = :instructions, image = :image 
            WHERE id = :id AND user_id = :user_id
        ");
        $update_query->execute([
            'name' => $name,
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            'image' => $image,
            'id' => $recipe_id,
            'user_id' => $user_id
        ]);
        header('Location: account.php');
        exit;
    } catch (PDOException $e) {
        die("Ошибка: " . $e->getMessage());
    }
} else {
    header('Location: account.php');
    exit;
}

include '../templates/header.php';
?>
<h1>Редактировать рецепт</h1>
<form action="edit_recipe.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="recipe_id" value="<?= $recipe['id']; ?>">
    <input type="hidden" name="old_image" value="<?= htmlspecialchars($recipe['image']); ?>">

    <label for="name">Название рецепта:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($recipe['name']); ?>" required><br>

    <label for="ingredients">Ингредиенты:</label>
    <textarea name="ingredients" id="ingredients" required><?= htmlspecialchars($recipe['ingredients']); ?></textarea><br>

    <label for="instructions">Шаги приготовления:</label>
    <textarea name="instructions" id="instructions" required><?= htmlspecialchars($recipe['instructions']); ?></textarea><br>

    <label for="image">Изображение:</label>
    <?php if ($recipe['image']): ?>
        <img src="<?= htmlspecialchars($recipe['image']); ?>" alt="Изображение рецепта" width="200"><br>
    <?php endif; ?>
    <input type="file" name="image" id="image"><br>

    <button type="submit">Сохранить изменения</button>
</form>
<?php
include '../templates/footer.php';

