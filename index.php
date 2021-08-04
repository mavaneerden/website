<?php
    $title = "Index";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>Index</h1>
<ul>
    <li>Learning</li>
    <ul>
        <li><a href="learn/morse.php">Learn Morse code</a></li>
        <li><a href="learn/flags.php">Learn the flags of all countries</a></li>
    </ul>
    <li>Links</li>
    <ul>
        <li><a href="https://github.com/mavaneerden" target="_blank" rel="noopener noreferrer">Github</a></li>
        <li><a href="https://linkedin.com/in/marco-van-eerden" target="_blank" rel="noopener noreferrer">Linkedin</a></li>
    </ul>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>