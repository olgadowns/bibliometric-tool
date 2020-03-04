<h1>Papers</h1>

<h2><a href="<?= $paper->url ?>" target="_blank"><?= $paper->title ?></a></h2>

<?= $paper->abstract ?>

<br/>
<br/>

<center>
  <a href="/papers/keep/<?=$paper->id?>"><button class="button button-outline">Yes Keep</button></a><a href="/papers/hide/<?=$paper->id?>"><input class="button button-clear" type="submit" value="No, exclude"></a>
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

<h4>Notes</h4>
<form action="/paper/update/<?= $paper->id?>" method="post">
<textarea id="notes"></textarea>

<div class="row">
    <div class="column">
        <label for="bias">Methodology</label>
        <select id="bias">
            <option value="Mixed Methods">Mixed Methods</option>
            <option value="Quantitative">Quantitative</option>
            <option value="Qualitative">Qualitative</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="column">
        <label for="bias">Bias</label>
        <select id="bias">
            <option value="0">No Bias, methodology sound</option>
            <option value="1">Possible bias, be carefull</option>
            <option value="3">Obvious bias, dont use</option>
        </select>
    </div>
    <div class="column">
        <label for="rating">Rating</label>
        <select id="rating">
            <option value="0">0 - No Value</option>
            <option value="1">1 - Interesting, not relevant</option>
            <option value="2">3 - Contains reference or idea I want to use</option>
            <option value="3">MUST USE</option>
        </select>
    </div>
    <div class="column">
        <br/>
        <br/>
        <button class="button button-outline" type="submit" style="width: 200px">Save</button>
    </div>
</div>
</form>

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
