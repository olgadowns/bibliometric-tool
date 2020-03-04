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
        <?= $paper->publication; ?>
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
<?php echo $this->Form->create($paper->Details, [
        'url' => "/papers/update/" . $paper->id,
        'type' => 'POST'
]); ?>

<?= $this->Form->textarea('notes', ['value' => $paper->Details->notes]); ?>

<?= $this->Form->hidden('id', ['value' => $paper->Details->id]); ?>
<?= $this->Form->hidden('paper_id', ['value' => $paper->id]); ?>
<?= $this->Form->hidden('paper_title', ['value' => $paper->title]); ?>

<div class="row">
    <div class="column">
        <label for="bias_score">Bias</label>
        <?php
        $bias = [
            '-1' => 'Not Checked',
            '1' => 'No obvious bias, methodology sound',
            '2' => 'Possible bias, be careful',
            '3' => 'Obvious bias, dont use',
            '4' => 'Other',

        ];
        echo $this->Form->select('bias_score', $bias, ['default' => '-1']);
        ?>
    </div>

    <div class="column">
        <label for="rating">Methodology</label>
        <?php
        $methodology = [
            '-1' => 'Not Checked',
            '1' => 'Mixed Methods',
            '2' => 'Quantitative',
            '3' => 'Qualitative',
            '4' => 'Other',
        ];
        echo $this->Form->select('methodology', $methodology, ['default' => '-1']);
        ?>
    </div>
    <div class="column">
        <label for="rating">Rating</label>
        <?php
        $ratings = [
            '-1' => 'Not checked',
            '1' => '1 - Of no Values',
            '2' => '2 - Interesting, not relevant',
            '3' => '3 - Contains reference or idea I want to use',
            '4' => '4 - MUST USE',
            '5' => '0 - Other',

        ];
        echo $this->Form->select('rating', $ratings, ['default' => '-1']);
        ?>
    </div>
    <div class="column">
        <br/>
        <br/>
        <button class="button button-outline" type="submit" style="width: 200px">Save</button>
    </div>
</div>
<?php echo $this->Form->end(); ?>

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

<br/>
<br/>

<div class="row">
    <div class="column">
        <h4>Article Details</h4>
        <br/>
        DOI: &nbsp;&nbsp;&nbsp; <?= $paper->doi; ?>
        <br/>
        ISSN:&nbsp;&nbsp;&nbsp; <?= $paper->issn; ?>
        <br/>
        EISSN: <?= $paper->eissn; ?>
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