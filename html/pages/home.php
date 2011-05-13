<?
    $subtitles = $data['subtitles'];
?>

<p>User Creations</p>

<ol>
<?
    foreach ($subtitles as $sub) {
        ?><li><a href="/<?= $sub['sub_id'] ?>"><?php echo htmlentities($sub['title'], ENT_COMPAT, 'UTF-8', true); ?></a></li><?
    }
?>
</ol>

<p><a href="/create">Or, create a new one</a></p>


<br />
<hr />

<div id="footer">
    <p><strong>'Downfall' Subtitle Builder</strong> is a hack made at a hackday event by <a href="http://twitter.com/derek">@derek</a>. I'm going to go ahead and classify this as "pre-pre-alpha" since it kinda barely maybe works.</p>
    <p><strong>Why?</strong> Because the "Downfall" meme awesome and we need more videos. Check out <a href="http://knowyourmeme.com/memes/downfall-hitler-meme">Know Your Meme</a> if you are totally confused.  Also, query "<a href="http://www.youtube.com/results?search_query=hitler+downfall&aq=f">hitler downfall</a>" on YouTube for another good place to start.</p>
</div>
