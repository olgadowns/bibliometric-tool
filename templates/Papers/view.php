<h1>Papers</h1>

<h2><?= $paper->title ?> - (<?= $paper->publication_date ?>)</h2>

<?= $paper->abstract ?>

<br/>
<br/>

<center>
  <button class="button button-outline">Yes Keep</button>
  <input class="button button-clear" type="submit" value="No, exclude">
</center>

<br/>
<br/>

<div class="row">
    <div class="column">
        <h4>Details</h4>
        Date:   <?= $paper->publication_date->format('F Y'); ?>
        <br/>
        Type:   <?= $paper->content_type->content_type ?>
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
