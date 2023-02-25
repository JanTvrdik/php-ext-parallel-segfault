# Step to reproduce the segfault

Run the following command:

```sh
docker build . -t segfault && docker run --rm -ti segfault
```


## Known requirements to trigger segfault

* bootstrap file must be used (but can be empty)
* opcache must be enabled


## GDB output

```
(gdb) run run.php
Starting program: /usr/local/bin/php run.php
warning: Error disabling address space randomization: Operation not permitted
[Thread debugging using libthread_db enabled]
Using host libthread_db library "/lib/x86_64-linux-gnu/libthread_db.so.1".
[New Thread 0x7f6b10723700 (LWP 454)]
[New Thread 0x7f6b0fbff700 (LWP 455)]
[New Thread 0x7f6b0efff700 (LWP 456)]
[New Thread 0x7f6b0e3ff700 (LWP 457)]
[New Thread 0x7f6b0d7ff700 (LWP 458)]
[New Thread 0x7f6b0cbff700 (LWP 459)]

Thread 6 "php" received signal SIGSEGV, Segmentation fault.
[Switching to Thread 0x7f6b0d7ff700 (LWP 458)]
0x000055bf0f607297 in ?? ()
(gdb) bt
#0  0x000055bf0f607297 in ?? ()
#1  0x000055bf0f609a06 in zend_do_link_class ()
#2  0x000055bf0f547c43 in zend_bind_class_in_slot ()
#3  0x000055bf0f547d6e in do_bind_class ()
#4  0x000055bf0f5a63d5 in ?? ()
#5  0x000055bf0f5da3f5 in execute_ex ()
#6  0x000055bf0f5616a4 in zend_call_function ()
#7  0x000055bf0f561b4d in zend_call_known_function ()
#8  0x000055bf0f432c9a in ?? ()
#9  0x000055bf0f560755 in zend_lookup_class_ex ()
#10 0x000055bf0f58aa85 in ?? ()
#11 0x000055bf0f5dd308 in execute_ex ()
#12 0x00007f6b1125dbd7 in php_parallel_scheduler_run (frame=0x7f6b0cc14020, runtime=<optimized out>) at /tmp/pear/temp/parallel/src/scheduler.c:316
#13 0x00007f6b1125e1bd in php_parallel_thread (arg=0x7f6b1105c5a0) at /tmp/pear/temp/parallel/src/scheduler.c:486
#14 0x00007f6b146f1ea7 in start_thread (arg=<optimized out>) at pthread_create.c:477
#15 0x00007f6b13e3ea2f in clone () at ../sysdeps/unix/sysv/linux/x86_64/clone.S:95
```
