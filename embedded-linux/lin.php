<?php
    $title = "Embedded Software - LIN";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>LIN</h1>

<p>
LIN stands for Local Interconnect Network and is a digital protocol designed for communication.
</p>

<h2>Hardware</h2>
<p>
The native LIN protocol uses a master/slave architecture with one master and up to 63 slaves. LIN uses only one data line
on which the data is transmitted. It is a higher-level protocol that can use a lower-level protocol such as UART as the underlying communication protocol.
The TXD and RXD lines can be converted to a single line in hardware.
</p>

<h2>Protocol definition</h2>
<p>
The LIN protocol uses message frames to transfer data. These frames are structured as follows:
<ol>
<li>Synchronization break: a minimum of 13 dominant bits + one recessive bit (break delimiter).</li>
<li>Synchronization byte: sequence of 8 alternating bits, used to synchronize bus time.</li>
<li>Protected ID (PID) byte: defines action to be fulfilled by LIN slaves. This field is 6 ID bits + 2 parity bits.</li>
<li>Data bytes: up to 8 bytes of data.</li>
<li>Checksum byte: used to validate the frame.</li>
</ol>
There are six types of message frames.
<ul>
<li>Unconditional frame: master requests information from a slave by sending a header without data periodically.</li>
<li>
    Event-triggered frame: master polls slaves by sending a header and the slaves respond only when the data has changed.
    The PID is added to the first byte of the data to differentiate between slaves.
</li>
<li>Sporadic frame: master requests information from a slave by sending a header without data aperiodically.</li>
<li>Diagnostic frame: ID 60 used for master request, ID 61 used for slave response.</li>
<li>User-defined frame: ID 62, may contain any data defined by the user.</li>
<li>Reserved frame: ID 63, should not be used.</li>
</ul>
The LIN master ONLY ever sends message headers. Slaves can choose to ignore headers, do an internal action or send a message back.
A device can be both a master and a slave. This slave task can be used to react to messages from other slaves or to react to the headers of the same device.
In this way, a master device can use data by itself by listening to its own headers in slave mode.
</p>

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="https://www.lin-cia.org/fileadmin/microsites/lin-cia.org/resources/documents/LIN_2.2A.pdf">LIN 2.2A specification</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>