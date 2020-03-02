<h1><?= $keyword['word'] ?></h1>

<table>
  <tr>
      <th>ID</th>
      <th>Title</th>
  </tr>
     <?php foreach ($keyword->papers as $paper): ?>
  <tr>
      <td><?= $paper['id'] ?> </td>
      <td><a href="/papers/view/<?= $paper['id'] ?>"><?= h($paper['title']) ?></a></td>
  </tr>
  <?php endforeach; ?>
</table>
