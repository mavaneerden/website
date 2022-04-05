<?php
    $title = "Embedded Software - I2C";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>I2C</h1>

<p>
I2C stands for Inter Integrated Circuit and is a synchronous serial protocol designed for communication between ICs on a device.
</p>

<h2>Hardware</h2>
<p>
The I2C protocol uses a master/slave architecture. Each slave has its own hardware-defined 7-bit address. The protocol has two wires:
<ul>
    <li>The clock (SCL) which defines the baud rate at which data is sent over the bus (100kHz, 400kHz, 1MHz, 3.4MHz, 5MHz, idle bus = high signal).</li>
    <li>The bi-directional data line (SDA), which sends the data bits as a digital signal (idle bus = high signal).</li>
</ul>
If there are multiple masters, bus arbitration is used to distinguish between masters. If a master sees that the data on
SDA does not equal the data that it sent, it should try again when the bus is unoccupied.
</p>

<h2>Protocol definition</h2>
<p>
The I2C protocol consists of the following stages:
<ol>
    <li>START: SDA is pulled low while SCL is still high</li>
    <li>
        Addressing: SCL is activated and the master sends the address of the slave it wants to talk with via SDA.
        The 8th bit of the address is the R/W bit. When the R/W bit is 1, the master wants to read from the device.
        When the R/W bit is 0, the master wants to write to the device.
    </li>
    <li>Intermediate pause: SCL is pulled low until data is sent</li>
    <li>
        Sending data: the master or slave (depending on the R/W bit) sends data via SDA.
        Data is sent in bytes and the transmitter can send as many bytes as it wants.
        There can be intermediate pauses between each data frame.
    </li>
    <li>STOP: communication between two devices is terminated when SCL goes high before SDA.</li>
</ol>
An acknowledge (ACK) bit is sent by the receiving device after addressing or sending a data byte.
If the ACK bit is not pulled low in time, there is an error in the receiving device.
</p>

<h2>I2C in embedded Linux</h2>
<p>
In embedded linux, there are multiple possible ways to use I2C and I will be discussing two of them here.
</p>

<h3>I2C using kernel modules</h3>
<p>
The Linux kernel has some useful functions for sending and receiving messages via I2C.
We can use the device tree standard (if supported) to create an I2C device, then use that
in our code to create an i2c_client. Of course we can also directly instantiate the client without
using the device tree.<br>
The process for creating an I2C driver using kernel functions is as follows:
<ol>
    <li>
        Create an i2c_device_id struct table and add your device name + ID in it.
        The device ID is user-defined, it doesn't have to be the device address!
    </li>
    <li>
        Create an i2c_driver struct for the device. This struct requires the ID table and probe &amp; remove functions.
        The probe function is called when the driver is loaded, the remove function when it is unloaded.
    </li>
    <li>
        Create an i2c_board_info struct with the device name (user-defined) and the slave address of the device. This
        can later be used to instantiate the client.
    </li>
    <li>
        Create an i2c_adapter for the I2C bus that the device is on using the i2c_get_adapter function.
    </li>
    <li>
        Instantiate the i2c_client using the i2c_board_info and i2c_adapter structs, which give information about
        the address and bus of the device, making it addressable.
    </li>
    <li>
        Initialise the device by calling the i2c_put_adapter function.
    </li>
</ol>
When the module is loaded in, the device should be initialised and the system can communicate with the device via I2C.
</p>

<h3>I2C in user space</h3>
<p>
Similarly to GPIOs in user space, creating an I2C driver in user space is done using character device files.
The process goes as follows:
<ol>
    <li>
        Open the character device file that corresponds to the I2C bus that the device is on.
    </li>
    <li>
        Use the ioctl function with the I2C_SLAVE flag to specify the device that you want to communicate with.
    </li>
    <li>
        Use the ioctl function with the I2C_RDWR flag or the read/write functions to read or write from or to the I2C device.
    </li>
    <li>
        Make sure that the I2C bus file descriptor is closed when the program terminates!
    </li>
</ol>
</p>

<h2>Example: controlling an OLED module</h2>
<p>
In this example, we discuss a high-level overview of the communication protocol between an SSD1306 OLED display and
an embedded device.<br>
The SSD1306 has a wide range of commands that can be issued to change the behaviour of the display. These can be found
on pages 28-32 of the data sheet.<br>
The protocol to communicate with the display is as follows:
<ol>
    <li>
        Start the I2C protocol as usual, adding a START condition + sending the device address. The device address can be
        found in the data sheet as well.
    </li>
    <li>
        Send a control byte with the following format: [Co, D/C, 0, 0, 0, 0, 0, 0], where Co is the continuation bit and
        D/C is the data/control bit.
        <ul>
        <li>If Co == 0, then all following bytes are data bytes.</li>
        <li>If Co == 1, then all following bytes contain control bytes after each data byte is sent.</li>
        <li>If D/C == 0, then all following data bytes are part of a command.</li>
        <li>If D/C == 0, then all following data bytes are written to the GDDRAM and displayed on the screen.</li>
        </ul>
    </li>
    <li>
        Send one or more data bytes that contain the command or the data to write to the GDDRAM.
    </li>
    <li>
        Communication stops when a STOP condition is detected.
    </li>
</ol>
</p>

<br></br>

<h4>Terms used</h4>
<ul>
    <li>Synchronous serial protocol: devices use a shared clock on the serial bus.</li>
    <li>GDDRAM: Graphic Display Data Random Access Memory, memory that contains a pattern of pixels to be displayed on the screen.</li>
</ul>
<h4>Sources</h4>
<ul>
    <li><a href="https://www.nxp.com/docs/en/user-guide/UM10204.pdf">NXP I2C bus specification and user manual</a></li>
    <li><a href="https://www.kernel.org/doc/html/latest/i2c/index.html">Linux Kernel I2C documentation</a></li>
    <li><a href="https://cdn-shop.adafruit.com/datasheets/SSD1306.pdf">SSD1306 data sheet</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>