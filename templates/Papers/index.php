<div class="row">
    <div class="column"><h1>Papers</h1></div>
    <!-- <div class="column column-25 column-offset-50" style="text-align: right"><a href="/papers/index/keep">Keep</a> | <a href="/papers/index/exclude">Exclude</a> | <a href="/papers/index/all">All</a></div> -->
</div>

  <table>
    <tr>
        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
        <th><?= $this->Paginator->sort('title', 'Title') ?></th>
        <th><?= $this->Paginator->sort('Type', 'Type') ?></th>
    </tr>
       <?php foreach ($papers as $paper): ?>
    <tr>
        <td><?= $paper->id ?> </td>
        <td <?php

        if ($paper->include == 3)
        {
            echo 'style="background-color: rgba(255, 0, 0, 0.1)"';
        }
        else if ($paper->include == 1)
        {
            echo 'style="background-color: rgba(0, 255, 0, 0.1)"';
        }

        ?>>
            <?php if ($paper->include == 0) { echo '<strike>' ;} ?><a href="/papers/view/<?= $paper->id ?>"><?= h($paper->title) ?></a><?php if ($paper->include == 0) { echo '</strike>'; } ?>
        </td>
        <td <?php

        if ($paper->include == 3)
        {
            echo 'style="background-color: rgba(255, 0, 0, 0.1)"';
        }
        else if ($paper->include == 1)
        {
            echo 'style="background-color: rgba(0, 255, 0, 0.1)"';
        }

        ?>>
            <?= $paper->ContentType->content_type ?>
        </td>
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