<h1>Key words</h1>

  <table>
    <tr>
        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
        <th><?= $this->Paginator->sort('query', 'Query') ?></th>
        <th><?= $this->Paginator->sort('from_database', 'Database') ?></th>
        <th><?= $this->Paginator->sort('total_papers', 'Total Papers') ?></th>

    </tr>
       <?php foreach ($queries as $query): ?>
    <tr>
        <td><?= $query->id ?> </td>
        <td><a href="/queries/view/<?= $query->id ?>"><?= h($query->query) ?></a></td>
        <td><?= $query->from_database ?> </td>
        <td><?= $query->total_papers ?> </td>

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