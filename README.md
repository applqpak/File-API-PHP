# File-API-PHP
The simple feature-packed File API for PHP has arrived.

#Tutorial
`<?php include("Main.php"); try { $File = new File(); $File->create("file.txt"); $File->open("file.txt"); $File->chmod(0777); $File->write("Hi!"); echo "File Content: " . $File->read(); echo "<br />"; echo "File's Size: " . $File->filesize(); $File->close(); $File->delete(); } catch(\FileException $exception) { die("<center>" . $exception->getMessage() . "</center>"); }`

###When run, this script will create the file "file.txt" and write "Hi!" to it, then read the data and display it's filesize(should return "3 Bytes"), then closes the stream and deletes the file.

#Functions
`File::create($fileName)` - pretty self-explanatory, creates the specified file.

`File::open($fileName)` - pretty self-explanatory, opens a stream with the specified file.

`File::chmod($permissions)` - pretty self-explanatory, chmods the file opened with File::open.

`File::write($data)` - pretty self-explanatory, writes the specified data to the file opened with File::open.

`File::read` - pretty self-explanatory, reads all the data from the file opened with File::open.

`File::filesize(void)` - pretty self-explanatory, returns the filesize of the file opened with File::open(including the unit(Bytes, KB, MB, etc...)).`

`File::close(void)` - pretty self-explanatory, closes the stream to the file opened with File::open.

`File::delete(void)` - pretty self-explanatory, deletes the file opened with File::open.
