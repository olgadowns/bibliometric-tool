<h1><?= $author->name ?></h1>

<div class="row">
    <div class="column">
        <h4>Papers</h4>
              <ul>
                <?php foreach ($author->papers as $paper) {
                  ?>
                  <li class="bullet success"><a href="/papers/view/<?= $paper['id'] ?>"><?= $paper['title'] ?></a></li>
                  <?php
                }
                ?>

              </ul>
    </div>
</div>
