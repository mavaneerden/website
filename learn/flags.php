<?php
    $title = "Learn flags";
    $stylesheets = ["/static/css/learn/flags.css"];
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>Learn flags</h1>

<div id="flag-image-container">
    <img id="flag-image" src=""/>
</div>
<br>
<div id="flag-input-container">
    <button id="flag-button-skip">Skip</button>
    <img id="loading" width="14" src="https://media1.tenor.com/images/d6cd5151c04765d1992edfde14483068/tenor.gif"/>
    <form id="flag-form">
        <input id="flag-input-text" type="text"/>
        <button id="flag-button-submit" type="submit">Submit</button>
    </form>
    <span id="flag-feedback"></span>
</div>


<script type="text/javascript" src="/static/js/learn/flags.js"></script>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>