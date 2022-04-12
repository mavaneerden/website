<?php
    $title = "Embedded Software - RS-232";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>RS-232</h1>

<p>
RS-232 is a Recommended Standard hardware-defined protocol used for communication.
</p>

<h2>Hardware</h2>
<p>
The RS-232 protocol is a master-slave protocol where the master is called Data Terminal Equipment (DTE) and the slave is Data Circuit-terminating Equipment (DCE).
The idle state of the RS-232 bus is high.
The protocol has a number of different signals (also known as circuits):
</p>
<h3>Ground signals</h3>
<ul>
<li>Protective Ground (PG): functions as an external ground.</li>
<li>Signal Ground (GND): reference ground for all other signals.</li>
</ul>
<h3>Data signals</h3>
<ul>
<li>TXD: line for transmitting data.</li>
<li>RXD: line for receiving data.</li>
</ul>
<h3>Control signals</h3>
<ul>
<li>Request To Send (RTS): when on, activates transmission mode.</li>
<li>Clear To Send (CTS): when on, signals to the DTE that it can transmit.</li>
<li>Data Set Ready (DSR): when on, DCE is ready to send/receive data.</li>
<li>Data Terminal Ready (DTR): when on, DTE is ready for communications.</li>
</ul>

<h2>Protocol definition</h2>
<p>
The RS-232 protocol is similar to UART and goes as follows:
<ul>
<li>Preparation: RTS and DTR are asserted by the DTE. CTS and DSR are asserted by the DCE.</li>
<li>Start: insert a single START bit that pulls the TXD signal low.</li>
<li>Data: send up to 8 data bits.</li>
<li>Stop: send a single STOP bit which is a high signal.</li>
</ul>
</p>

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="http://duinorasp.hansotten.com/uploads/2740_EIA_RS-232-C.pdf">EIA RS-232-C specification</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>