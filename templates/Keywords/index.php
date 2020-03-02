<h1>Key words</h1>

  <table>
    <tr>
        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
        <th><?= $this->Paginator->sort('word', 'Word') ?></th>
        <th><?= $this->Paginator->sort('total_papers', 'Total Papers') ?></th>

    </tr>
       <?php foreach ($keywords as $word): ?>
    <tr>
        <td><?= $word->id ?> </td>        
        <td><a href="/keywords/view/<?= $word->id ?>"><?= h($word->word) ?></a></td>
        <td><?= $word->total_papers ?> </td>

    </tr>
    <?php endforeach; ?>
</table>


<?= $this->Paginator->numbers() ?>

<?= $this->Paginator->prev('« Previous') ?>
<?= $this->Paginator->next('Next »') ?>

<?= $this->Paginator->counter() ?>
