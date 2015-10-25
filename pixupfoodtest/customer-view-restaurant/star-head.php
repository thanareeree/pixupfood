<?php
$scoreRes = $con->query("SELECT COUNT(score) as count, SUM(score) as score FROM `comment` WHERE restaurant_id = '$resid' GROUP BY restaurant_id");
$scoreData = $scoreRes->fetch_assoc();
$count = $scoreData["count"];
$score = $scoreData["score"];
$star = round($score / $count);
?>
<form id="ratingsForm">
    <div class="stars">
        <input type="radio" name="star[]" class="star-1" id="star-1" disabled="" <?= ($star == 1 ? 'checked' : '') ?>/>
        <label class="star-1" for="star-1">1</label>
        <input type="radio" name="star[]" class="star-2" id="star-2" disabled="" <?= ($star == 2 ? 'checked' : '') ?>/>
        <label class="star-2" for="star-2">2</label>
        <input type="radio" name="star[]" class="star-3" id="star-3" disabled="" <?= ($star == 3 ? 'checked' : '') ?>/>
        <label class="star-3" for="star-3">3</label>
        <input type="radio" name="star[]" class="star-4" id="star-4" disabled="" <?= ($star == 4 ? 'checked' : '') ?>/>
        <label class="star-4" for="star-4">4</label>
        <input type="radio" name="star[]" class="star-5" id="star-5" disabled="" <?= ($star == 5 ? 'checked' : '') ?>/>
        <label class="star-5" for="star-5">5</label>
        <span></span>
    </div>
</form>
