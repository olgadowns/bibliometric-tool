<h1><?= $query['query'] ?></h1>

<table>
  <tr>
      <th>ID</th>
      <th>Title</th>
  </tr>
     <?php foreach ($query->papers as $paper): ?>
  <tr>
      <td><?= $paper['id'] ?> </td>
      <td><a href="/papers/view/<?= $paper['id'] ?>"><?= h($paper['title']) ?></a></td>
  </tr>
  <?php endforeach; ?>
</table>
