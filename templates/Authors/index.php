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


<?= $this->Paginator->numbers() ?>

<?= $this->Paginator->prev('« Previous') ?>
<?= $this->Paginator->next('Next »') ?>

<?= $this->Paginator->counter() ?>


<?php
/*



<table>
  <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Total Papers</th>
  </tr>
     <?php foreach ($authors as $author): ?>
  <tr>
      <td><?= $author->id ?> </td>
      <td><?= h($author->name) ?> </td>
      <td><?= $author->TotalPapers ?> </td>

  </tr>
  <?php endforeach; ?>
</table>
*/ ?>
