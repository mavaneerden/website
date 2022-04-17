<?php
    $title = "Embedded Software - Inter-process communication";
    include "$_SERVER[DOCUMENT_ROOT]/templates/page_head.php";
?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/header.php"; ?>

<h1>Inter-process communication</h1>
<p>
On this page, we discuss constructions that one can use for inter-process communication on a Linux system.
The following things are discussed:
<ol>
<li>Shared data</li>
<li>Message queues</li>
<li>Pipes</li>
<li>Sockets</li>
<li>Signals</li>
</ol>
</p>

<!---------SHARED DATA------------>

<h2>Shared data</h2>
<p>
By default, different processes have different address spaces and thus do not share any memory. One solution to this is
the usage of shared files.
</p>

<h3>Shared files</h3>
<p>
Files can be used to for one process to write, and another to read data. To avoid race conditions, the writing process can
use an exclusive lock on the file, which prevents other processes from reading/writing. The reading process can use a shared lock
which can be held by multiple processes and prevents writing to the file.<br>
An advantage of this method is that a lot of data can be shared using shared files. A downside is that file access is relatively slow.
</p>

<h3>Shared memory</h3>
<p>
In Linux, a process can allocate shared memory in its virtual address space using the mmap function.
Other processes can access the shared memory region by using a shared file.
To identify the shared file, the processes need to share some code that contains the name of the file.
Just like with the shared files, race conditions can occur.
For this reason, there are various structures that can be used to synchronise shared memory access, which are discussed below.
</p>

<h4>Atomics</h4>
<p>
An atomic variable is a variable that can only be accessed and modified atomically. This means only one process or thread can
do something with the variable at the same time.
</p>

<h4>Mutex locks</h4>
<p>
For more complicated atomic operations, one can use a mutually exclusive (mutex) lock.
When a process or thread acquires the lock, no other process or thread can acquire it until it is released.
Just as with shared files, there are also shared locks which allow multiple processes or threads to acquire the lock at the same time.
</p>

<h4>Semaphores</h4>
<p>
A (counting) semaphore is an atomic variable that can be incremented and decremented atomically.
This can be used to have a process wait for a certain count and then do an action.
A counting semaphore can also act as a (shared) mutex lock by incrementing the value when it is acquired, and decrementing the value when it is released.
</p>

<h4>Condition variables</h4>
<p>
Condition variables are data structures that are linked to a mutex lock, and the lock is only acquired when a certain
condition is evaluated as true. The lock can also be acquired when the condition variable is notified to do so by another process or thread.
</p>

<!---------MESSAGE QUEUES------------>

<h2>Message queues</h2>
<p>
Message queues can be used to receive data in an arbitrary order.
The queues are defined by an ID that needs to be shared between processes.
</p>

<h2>Pipes</h2>
<p>
Pipes act as unidirectional FIFO queues and are structures that can be used to read and write data in a thread-safe manner.
Each pipe has a read end and a write end, so two file descriptors are used.
These descriptors can be shared by forking a child process from a parent process.
</p>

<h3>Named pipes</h3>
<p>
A named pipe is a pipe that uses a shared file as the buffer, and it is bidirectional.
It is identified by a name that needs to be shared between processes that want to use the pipe.
Reading and writing can be done by doing those operations on the shared file.
</p>

<!---------SOCKETS------------>

<h2>Sockets</h2>
<p>
Sockets can be used to communicate between processes on the same device, but also on different devices.
A server sets up a socket, binds it to an address + port and accepts client connection requests.
Unlike an unnamed pipe, a socket can be used in both directions, where both server and client read and write.
</p>

<!----------SIGNALS----------->

<h2>Signals</h2>
<p>
Signals can be used to communicate that a process should do a certain action.
One process sends the signal, and the other process assigns a callback function to it, which is called whenever the signal is received.
This can be used to overwrite default functionalities of signals in Linux.
</p>

<h4>Sources</h4>
<ul>
    <li><a href="https://opensource.com/sites/default/files/gated-content/inter-process_communication_in_linux.pdf">A guide to inter-process communication in Linux</a></li>
</ul>

<?php include "$_SERVER[DOCUMENT_ROOT]/templates/elements/footer.php"; ?>
<?php include "$_SERVER[DOCUMENT_ROOT]/templates/page_foot.php"; ?>