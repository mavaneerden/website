<?php
    $title = "Embedded Software - RS-485";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>RS-485</h1>

<p>
RS-485 is a Recommended Standard hardware-defined protocol used for communication.
</p>

<h2>Hardware</h2>
<p>
The RS-485 protocol is a master-slave protocol with multiple masters (the 'drivers', 'generators' or 'DTEs') and multiple receivers ('DCEs') on a single bus.
It uses a twisted pair of differential signals, which makes it resistant to noise and allows a cable length of up to 1200m.
An extra ground wire can also be used to connect the local grounds of the devices to eachother.
The protocol requires two termination resistors per bus, to avoid reflections of the signal through the cable.
<br>
Since RS-422 is a subset of RS-485, RS-422 communication can easily be converted into RS-485 communication.
</ul>

<h2>Protocol definition</h2>
<p>
The RS-485 protocol is only defined in hardware, so any higher-layer protocol needs to be defined in software.
</p>

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="https://www.ti.com/lit/an/slla070d/slla070d.pdf">RS-422 and RS-485 Standards Overview and System Configurations</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>