<?php
    $title = "Embedded Software - CAN";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>CAN</h1>

<p>
CAN stands for Controller Area Network and is a digital communication protocol. We will be discussing CAN 2.0 here.
</p>

<h2>Hardware</h2>
<p>
CAN is a peer-to-peer protocol where one bus can have up to 127 devices. The protocol uses a twisted pair of differential signals (CAN low and CAN high),
with an optional ground wire and an optional shield wire. CAN networks support a transfer speed of up to 1Mbit/s. This speed needs to be agreed upon before activating the devices.
</p>

<h3>Arbitration</h3>
<p>
In the CAN protocol, it is possible for two devices to transmit at the same time. To avoid conflicts, CAN uses arbitration. In this concept, two transmitting nodes
monitor the bus to see if the bits they transmit correspond to what they see on the bus. Because a dominant (0) bit 'overwrites' a recessive (1) bit due to the hardware used,
a CAN message with a lower ID will transmit its bits. A CAN transceiver that transmits a messsage with a higher ID detects that the wrong bits are on the bus and stops transmitting.
All of this means that the concept of arbitration not only avoids bus conflicts, but also allows for giving messages a priority according to their ID value.
</p>

<h2>Protocol definition</h2>
<p>
Messages in CAN are transmitted using frames. There are four frame types:
<ul>
<li>Data frame: used to directly transmit data.</li>
<li>Remote frame: used to request a data frame from a different device.</li>
<li>Error frame: transmitted when an error is detected.</li>
<li>Overload frame: can be used as a delay between messages.</li>
</ul>

The data frame and remote frames consist of the following fields:
<ol>
<li>Arbitration field (ID): the unique message identifier. The length is 11 bits for a standard frame and 29 bits for an extended frame.</li>
<li>Remote Transmission Request (RTR) flag: when this is 1, the message is a remote frame. Else it is a data frame.</li>
<li>Identifier extension (IDE) flag: when this is 1, the frame is an extended frame. Else it is a standard frame.
<li>Data Length Code: a 4-bit encoding that defines the length of data sent when this is a data frame. Defines the length of the data to be sent by the receiver when this is a remote frame.</li>
<li>Data: contains up to 8 bytes of data to send. This field is not included in remote frames. </li>
<li>Cyclic Redundancy Check (CRC): 15 bits of CRC for error checking.</li>
<li>Acknowledgement (ACK): used by the receiver to acknowledge a message.</li>
</ol>
</p>

<h3>Extended frame format</h3>
<p>
As mentioned above, CAN supports both 11-bit and 29-bit message IDs. The 29-bit ID is part of the extended frame format. In this format, the ID consists of the
normal 11-bit ID, plus an additional 18-bit ID. The 11-bit ID can, for example, be used to define the base priority of a message by using the arbitration concept discussed above.
The 18-bit ID can then be used to distinguish messages with the same priority.<br>
A CAN transceiver can distinguish a standard frame from an extended frame by looking at the IDE bit as mentioned above.
</p>

<h3>Bit stuffing</h3>
<p>
Because the CAN protocol does not have a shared clock, it may be possible for the internal clocks of devices to be slightly off.
When a long sequence of 0s or 1s are sent over the bus, it could be that the receiving device loses track of how many bits there are in the sequence.
To avoid this, bit stuffing is used. Here, the transmitting device inserts an inverted bit if a sequence of 6 or more bits are the same.
This allows the internal clock of the receiver to 'synchronise' with the clock of the transmitter.
</p>


<h2>Can with Flexible Data-rate (CAN-FD)</h2>
<p>
The CAN-FD protocol is an extension of the CAN protocol and allows for higher data rates, as well as the transmission of up to 64 bytes of data in a single frame.
This protocol is backwards compatible with the classical CAN protocol discussed above.<br>
The CAN-FD protocol uses three extra fields in each message:
<ul>
<li>Extended Data Length (EDL): this field is always 1 for CAN-FD frames and is used to distinguish between CAN and CAN-FD messages.</li>
<li>Bit Rate Switch (BRS): if this is 1, the data rate is increased when sending the DLC, data and CRC part of a frame. If this is 0, the data rate stays the same throughout frame transmission.</li>
<li>Error State Indicator (ESI): defines the error state of the transmitter.</li>
</ul>
To enable up to 64 bytes of data, the DLC encoding of a CAN-FD frame is different from the one used in CAN.
</p>

<br></br>

<!-- <h4>Terms used</h4>
<ul>
    <li></li>
</ul> -->
<h4>Sources</h4>
<ul>
    <li><a href="http://esd.cs.ucr.edu/webres/can20.pdf">CAN 2.0 basic concepts</a></li>
    <li><a href="https://www.can-cia.org/fileadmin/resources/documents/proceedings/2012_hartwich.pdf">CAN with Flexible Data-Rate (Florian Hartwich, Robert Bosch)</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>