<h1>Papers</h1>

<h2><?= $paper->title ?></h2>

<?= $paper->abstract ?>

<br/>
<br/>

<center>
  <a href="/papers/keep/<?=$paper->id?>"><button class="button button-outline">Yes Keep</button></a>
    <a href="/papers/hide/<?=$paper->id?>"><input class="button button-clear" type="submit" value="No, exclude"></a>
</center>

<br/>
<br/>

<div class="row">
    <div class="column">
        <h4>Details</h4>
        <?= $paper->content_type->content_type ?>
        <br/>
        Published <?= $paper->publication_date->format('F Y'); ?>
    </div>

    <div class="column">
        <h4>Queries</h4>
        <ul>
            <?php foreach ($paper->Queries as $query) {
                ?>
                <li class="bullet success"><a href="/queries/view/<?= $query['id'] ?>"><?= $query['query'] ?></a></li>
                <?php
            }
            ?>

        </ul>
    </div>

</div>


<br/>

<div class="row">
    <div class="column">
        <h4>Authors</h4>
              <ul>
                <?php foreach ($paper->Authors as $author) {
                  ?>
                  <li class="bullet success"><a href="/authors/view/<?= $author['id'] ?>"><?= $author['name'] ?></a></li>
                  <?php
                }
                ?>

              </ul>
    </div>
    <div class="column">
        <h4>Key Words</h4>
              <ul>
                <?php foreach ($paper->Keywords as $word) {
                  ?>
                  <li class="bullet success"><a href="/keywords/view/<?= $word['id'] ?>"><?= $word['word'] ?></a></li>
                  <?php
                }
                ?>
              </ul>
    </div>
</div>
