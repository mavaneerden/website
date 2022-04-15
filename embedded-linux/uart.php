<?php
    $title = "Embedded Software - UART";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>UART</h1>

<p>
UART stands for Universal Asynchronous Receiver/Transmitter and is an asynchronous serial protocol designed for communication.
</p>

<h2>Hardware</h2>
<p>
The native UART protocol uses an architecture where only two devices are in a network. UART has two wires:
<ul>
    <li>TXD: transmit data wire. The transmission pin of one device is connected to the receiving pin of the other.</li>
    <li>RXD: receive data wire. The receiving pin of one device is connected to the transmission pin of the other.</li>
</ul>
UART can also have four wires: the TXD and RXT plus two additional ones.
<ul>
    <li>CTS: Clear To Send wire, active low. The transmitter checks if it is active before sending.</li>
    <li>RTS: Request To Send, active low. The receiver pulls this high if its receiving queue is full and the transmitter checks it.</li>
</ul>
It is possible to support multiple devices, but support for this needs to be defined in software.
</p>

<h2>Protocol definition</h2>
<p>
The UART protocol consists of the following stages:
<ol>
    <li>Start: TXD is pulled low for one bit, which is the START bit.</li>
    <li>
        Sending data: UART sends 5-8 bits of data + an optional parity bit for error checking.
    </li>
    <li>Stop: UART sends 1-2 STOP bits, which are always high.</li>
</ol>
Since UART is asynchronous, the baud rate and data length need to be agreed on before communication.
</p>

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="https://www.ti.com/lit/ug/sprugp1/sprugp1.pdf">TI UART User's Guide</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>