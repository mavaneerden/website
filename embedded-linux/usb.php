<?php
    $title = "Embedded Software - USB";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>USB</h1>

<p>
USB stands for Universal Serial Bus and is a protocol that can be used for communication.
</p>

<h2>Hardware</h2>
<p>
USB is a master-slave protocol where the master is called the 'host' and the slaves are the 'devices'.
There are several versions of USB. Here, we discuss only version 2.0 using low and full speed, which has four wires.
<ul>
<li>The power wire provides power to the USB device.</li>
<li>The ground wire is used as a ground for the power wire.</li>
<li>The D+ wire is one of the differential signals.</li>
<li>The D- wire is one of the differential signals. It always has the opposite value of the D+ wire.</li>
</ul>
The communication wires (D+ and D-) are a twisted pair of differential signals.
The differential pair can be in one of four states:
<ol>
<li>D+ is high and D- is low: differential 1 ('K'-state for low speed, 'J'-state for full speed).</li>
<li>D+ is low and D- is high: differential 0 ('J'-state for low speed, 'K'-state for full speed).</li>
<li>D+ is low and D- is low: single-ended 0 (SE0).</li>
<li>D+ is high and D- is high: single-ended 1 (SE1).</li>
</ol>
The low speed is 1.5Mbit/s, the full speed is 12Mbit/s. There is also high-speed ans super-speed, but those are not discussed here.
</p>

<h2>Protocol definition</h2>
<p>
When the device is plugged in, it enters the idle state (which is logically the same as the J-state). The host then needs to initiate communication with the device.
The communication consists of packets, which are sent LSB first in the following way:
<ul>
<li>
    Start-of-packet (SOP): both differential signals switch from the J-state to the K-state (the value of the K-state depends on the speed, see above).
    The first K-state here is part of the sync pattern.
</li>
<li>
    Sync pattern: used for clock synchronisation. For low-speed and full-speed, this is the following sequence: KJKJKJKK.
</li>
<li>
    Packet ID (PID): an 8-bit ID for the packet. The first 4 bits define the type of packet. The next 4 bits are the inverse of the 4 as an error correction check.
</li>
<li>
    Data: data sent over the USB bus. How the data is interpreted depends on what type of packet it is.
</li>
<li>
    End-of-packet (EOP): consists of two SE0s followed by at least one J-state bit (the value of the J-state also depends on the speed).
</li>
</ul>
All of the data and the PID in the USB protocol use the Non-return To Zero Inverted (NRZI) encoding. This encoding uses changes in the signal to
enode the data.
<ul>
<li>When the signal changes, the data is encoded as a logical 0.</li>
<li>When the signal doesn't change, the data is encoded as a logical 1.</li>
</ul>
The detection of changes starts from the last state of the sync pattern.
</p>

<h3>Packet types</h3>
<p>
The USB protocol discussed here employs the following packet types, all of which have different PIDs:
<ul>
<li>
Token packets are used by the host to request or transmit frames.
Each token packet contains an address and endpoint that identify a device, with a 5-bit Cyclic Redundancy Check (CRC) at the end.
The address is set by the host during the device discovery phase, which is discussed below.
There are four types of token packets:
    <ul>
    <li>OUT: indicates that the next packet that the host sends is a data packet aimed at the device that is addressed.</li>
    <li>IN: the host requests data from the device that is addressed.</li>
    <li>SOF: contains a frame number instead of address + endpoint. Sent by the host every millisecond on a full-speed bus.</li>
    <li>SETUP: used by the host for initial setup to establish communication with the device.</li>
    </ul>
</li>
<li>
Data packets consist of up to 8192 bits of data plus a 16-bit CRC. There are two types of data packet: DATA0 and DATA1.
Each device should alternate between using DATA0 and DATA1 to send packets. This allows the host device to easily check if
a data packet was missed.
</li>
<li>
Handshake packets are used for indicating successes and failures in communication. There are three types of handshake packets:
    <ul>
    <li>ACK: sent by the receiver, indicates that a data packet was successfully received without errors.</li>
    <li>NAK: sent by the device, indicates that data could not be accepted or there is no data to send.</li>
    <li>STALL: sent by the device, indicates that data could not be read or transmitted.</li>
    </ul>
</li>
</ul>
</p>

<h3>Bit stuffing</h3>
<p>
Similarly to CAN, the USB protocol employs bit stuffing to avoid erroneous reading of data. Since there is no clock in the USB protocol,
a large sequence of identical states could be interpreted in a wrong way when the clocks of the host and device do not exactly match.
Therefore, after every 6 identical states the state is switched, to allow the clocks to synchronise.
</p>

<h3>Device setup</h3>
<p>
When a device is connected to the USB network, the host will set up the communication to the device using the SETUP token.<br>
First, the host will set the address of the device. Then, the host asks the device for its device descriptor. This descriptor
describes what the device is and how it should operate.<br>
The host then gets the device manufacturer, description and serial number by using the device descriptor. The host also requests
the configuration(s) from the device. These configurations contain, among others, the class of the device.
<br>
The USB standard defines various device classes, with each device class having a descriptor. The host can request this descriptor from the device to
see what kind of device it is and which functionalities from its class the device supports. The host then uses this information to interface with the device.
</p>

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="https://eater.net/downloads/usb_20.pdf">Universal Serial Bus Specification</a></li>
    <li><a href="https://www.youtube.com/watch?v=wdgULBpRoXk">Video: How does a USB keyboard work?</a></li>
    <li><a href="https://www.youtube.com/watch?v=N0O5Uwc3C0o">Video: How does USB device discovery work?</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>