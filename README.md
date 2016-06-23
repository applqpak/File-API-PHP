# File-API-PHP
The simple feature-packed File API for PHP has arrived.

#Tutorial
`<?php include("Main.php"); try { $File = new File(); $File->create("file.txt"); $File->open("file.txt"); $File->chmod(0777); $File->write("Hi!"); echo "File Content: " . $File->read(); echo "<br />"; echo "File's Size: " . $File->filesize(); $File->close(); $File->delete(); } catch(\FileException $exception) { die("<center>" . $exception->getMessage() . "</center>"); }`
