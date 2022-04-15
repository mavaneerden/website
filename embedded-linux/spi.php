<?php
    $title = "Embedded Software - SPI";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>SPI</h1>

<p>
SPI stands for Serial Peripheral Interface and is a synchronous serial protocol designed for communication between ICs on a device.
</p>

<h2>Hardware</h2>
<p>
The SPI protocol uses a master/slave architecture. Each slave has its own wire with which the master can select the slave. The protocol has four wires:
<ul>
    <li>The clock (SCK) which defines the baud rate at which data is sent over the bus.</li>
    <li>The Master In Slave Out (MISO) line. When the device is a master, this is its input. Else this is its output.</li>
    <li>The Master Out Slave In (MOSI) line. When the device is a master, this is its output. Else this is its input.</li>
    <li>The Chip Select (CS)/Slave Select (SS), an active-high signal that is pulled low when the master wants to select the slave connected to it.</li>
</ul>
The network needs one CS line for every slave.
</p>

<h2>Protocol definition</h2>
<p>
The SPI protocol has four modes which consist of the CPHA and CPOL values. The value of CPOL determines if the clock is active high or active low.
The value of CPHA determines wheather the device samples the bits on a rising or falling edge.
<br>
The SPI protocol consists of the following stages:
<ol>
    <li>Start: CS is pulled low.</li>
    <li>
        Sending data: the protocol starts sending data on MISO or MOSI. If the CPHA variable is 1, data is sent after clock activation!
    </li>
    <li>Clock activation: the clock is activated after a defined lead time. The clock has a certain polarity (either 0 or 1) defined by the CPOL variable.</li>
    <li>Stop: SCK is stopped and CS is set to its idle state.</li>
</ol>
In many processors, SPI can be configured to transmit LSB first or MSB first.
Sometimes, SPI can also be used in a 3-wire format, where either MOSI, MISO or CS are not connected.
</p>

<h2>IsoSPI</h2>
When you want to use SPI over long distances, the isoSPI protocol can be used. This protocol consists of a
twisted pair of differential signals (IP and IM) to reduce the impact of noise. IsoSPI can be converted to and from SPI via specialised hardware.

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="https://www.nxp.com/files-static/microcontrollers/doc/ref_manual/S12SPIV4.pdf">NXP SPI block guide</a></li>
    <li><a href="https://www.analog.com/media/en/technical-documentation/tech-articles/Isolated-SPI-Communication-Made-Easy.pdf">Isolated SPI communication made easy</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>