<form method="post" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
  <label for="title">Заголовок:</label><br>
  <input type="text" id="title" name="title" required><br><br>

  <label for="content">Содержание:</label><br>
  <textarea id="content" name="content" rows="5" required></textarea><br><br>

  <label for="image">Изображение:</label><br>
  <input type="file" id="image" name="image" accept="image/*"><br><br>

  <button type="submit">Добавить пост</button>
</form>