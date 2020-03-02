<h1>Papers</h1>

  <table>
    <tr>
        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
        <th><?= $this->Paginator->sort('title', 'Title') ?></th>
    </tr>
       <?php foreach ($papers as $paper): ?>
    <tr>
        <td><?= $paper->id ?> </td>
        <td><a href="/papers/view/<?= $paper->id ?>"><?= h($paper->title) ?></a></td>
    </tr>
    <?php endforeach; ?>
</table>

// Shows the page numbers
<?= $this->Paginator->numbers() ?>

<?= $this->Paginator->prev('« Previous') ?>
<?= $this->Paginator->next('Next »') ?>

<?= $this->Paginator->counter() ?>
