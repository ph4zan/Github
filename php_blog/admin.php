<?php
$all_rights = [
    'Чтение'    => PERM_READ,
    'Запись'    => PERM_WRITE,
    'Изменение' => PERM_EDIT,
    'Удаление'  => PERM_DELETE,
];

// утилиты
function rights_to_array(int $mask, array $map): array {
    $res = [];
    foreach ($map as $name => $bit) {
        if ($mask & $bit) {
            $res[] = $name;
        }
    }
    return $res;
}
function array_to_mask(array $selected_names, array $map): int {
    $mask = 0;
    foreach ($selected_names as $name) {
        if (isset($map[$name])) {
            $mask |= $map[$name];
        }
    }
    return $mask;
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        exit('CSRF token mismatch');
    }

    $rights_input = $_POST['rights'] ?? []; // rights[user_id] = array of names
    $updateStmt = $pdo->prepare("UPDATE users SET rights = ? WHERE id = ?");

    $pdo->beginTransaction();
    try {
        foreach ($rights_input as $user_id => $names) {
            $mask = array_to_mask($names, $all_rights);
            $updateStmt->execute([$mask, $user_id]);
        }
        $pdo->commit();
        $message = "Права сохранены.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $message = "Ошибка: " . htmlspecialchars($e->getMessage());
    }
}

// Получаем юзеров
$stmt = $pdo->prepare("SELECT id, username, rights FROM users ORDER BY username ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if (!empty($message)): ?>
  <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
<input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
  <table border="1" cellpadding="4" cellspacing="0">
    <thead>
      <tr>
        <th>Пользователь</th>
        <?php foreach (array_keys($all_rights) as $right_name): ?>
          <th><?= htmlspecialchars($right_name) ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $u):
          $have = rights_to_array((int)$u['rights'], $all_rights);
      ?>
        <tr>
          <td><?= htmlspecialchars($u['username']) ?></td>
          <?php foreach ($all_rights as $name => $bit): ?>
            <td style="text-align:center;">
              <input type="checkbox"
                     name="rights[<?= (int)$u['id'] ?>][]"
                     value="<?= htmlspecialchars($name) ?>"
                     <?= in_array($name, $have, true) ? 'checked' : '' ?>>
            </td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p><button type="submit">Сохранить</button></p>
</form>
