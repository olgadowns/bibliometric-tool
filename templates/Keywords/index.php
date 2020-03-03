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

<br/>

<ul class="pagination">
    <li><?= $this->Paginator->prev('« Previous') ?></li>
    <?= $this->Paginator->numbers() ?>
    <li><?= $this->Paginator->next('Next »') ?></li>
</ul>

<center>
    <?= $this->Paginator->counter() ?>
</center>