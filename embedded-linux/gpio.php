<?php
    $title = "Embedded Software - GPIO";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>GPIO</h1>

<p>
GPIO stands for General Purpose Input/Output. GPIO pins can be controlled via software and have two modes: input and output.
</p>

<h2>Input mode</h2>
<p>
In input mode, the GPIO pin reads the voltage of the input as a digital signal. The signal is detected as high (1) when
it reaches above a certain threshold, which commonly lies above 0.5 * VCC. Similarly, the signal is detected as low (0) when it is below
a certain threshold. This threshold typically lies somewhere below 0.5 * VCC.<br>
When the GPIO pin is configured as input, it passes a logic 1 or logic 0 to the software, depending on if the input signal
is high or low respectively.
</p>

<h2>Output mode</h2>
<p>
In output mode, the GPIO pin outputs a voltage which is controlled by the software. When the software tells the GPIO pin
to output a high signal, the pin outputs a voltage close to VCC. Conversely, when the GPIO outputs a low signal, the voltage
of this signal is close to ground.<br>
When the GPIO pin is configured as output, the software passes a logic 1 or logic 0 to it. The GPIO pin then outputs
a digital signal. The value of the output signal depends on whether the pin is active-high or active-low.
</p>

<h2>GPIO in embedded Linux</h2>
<p>
In Linux, each GPIO device is represented by a file called gpiochip# in the /dev/ folder, where # is the chip number. Each chip has a number of lines
which each represent a single pin. Each line has the following functions:
<ul>
    <li>Setting the direction to input or output</li>
    <li>Setting the value of the output signal</li>
    <li>Reading the value of the line</li>
    <li>Enabling/disabling pull-up and pull-down resistors</li>
    <li>Enabling/disabling open-source and open-drain modes</li>
    <li>Enabling/disabling interrupts on rising edges, falling edges or both edges</li>
</ul>
When a process wants to use a GPIO line, it needs to request the line first to avoid conflicts with other processes. Once the process is done using
the GPIO line, the line can be released.<br>
The Linux kernel provides the programmer with the gpiolib, which can be used to interface with gpiochip files in C/C++.
</p>

<h2>Example: controlling an LED</h2>

<br></br>
<h4>Terms used</h4>
<ul>
    <li>VCC: Voltage at Common Collector, supply voltage.</li>
    <li>Digital signal: signal that represents either a logic 0 or a logic 1.</li>
</ul>
<h4>Sources</h4>
<ul>
    <li><a href="https://www.kernel.org/doc/html/latest/driver-api/gpio/index.html">Linux Kernel GPIO documentation</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>