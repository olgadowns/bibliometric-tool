<h1>Authors</h1>

<table>
  <tr>
      <th><?= $this->Paginator->sort('id', 'ID') ?></th>
      <th><?= $this->Paginator->sort('name', 'Name') ?></th>
      <th><?= $this->Paginator->sort('total_papers', 'Total Papers') ?></th>
  </tr>
     <?php foreach ($authors as $author): ?>
  <tr>
      <td><?= $author->id ?> </td>
      <td><a href="/authors/view/<?= $author->id ?>"><?= h($author->name) ?></a></td>
      <td><?= $author->TotalPapers ?> </td>

  </tr>
  <?php endforeach; ?>
</table>

<br/>

<ul class="pagination">
    <li><?= $this->Paginator->prev('« Previous') ?></li>
    <?= $this->Paginator->numbers() ?>
    <li><?= $this->Paginator->next('Next »') ?></li>
</ul>

<center>
    <?= $this->Paginator->counter() ?>
</center>