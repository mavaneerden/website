<?php
    $title = "Index";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>Index</h1>
<ul>
    <li>Embedded Software</li>
    <ul>
        <li><a href="embedded-linux/gpio.php">GPIO</a></li>
        <li><a href="embedded-linux/i2c.php">I2C</a></li>
        <li><a href="embedded-linux/spi.php">SPI</a></li>
        <li><a href="embedded-linux/uart.php">UART</a></li>
        <li><a href="embedded-linux/lin.php">LIN</a></li>
        <li><a href="embedded-linux/rs-232.php">RS-232</a></li>
        <li><a href="embedded-linux/rs-422.php">RS-422</a></li>
        <li><a href="embedded-linux/rs-485.php">RS-485</a></li>
        <li><a href="embedded-linux/can.php">CAN</a></li>
        <!-- <li><a href="embedded-linux/canopen.php">CANopen</a></li> -->
        <li><a href="embedded-linux/usb.php">USB</a></li>
        <li><a href="embedded-linux/inter-process-communication.php">Inter-process communication</a></li>
    </ul>
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