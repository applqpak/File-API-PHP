<?php

  /*
  --------------------------------------------------------------------------------
  |                                FileException class                           |
  --------------------------------------------------------------------------------
  */

  class FileException extends \Exception
  {

  }

  /*
  --------------------------------------------------------------------------------
  |                             FileInterface interface                          |
  --------------------------------------------------------------------------------
  */

  interface FileInterface
  {

    public function getInstance();

    public function getfileName();

    public function setfileName($newfileName = null);

    public function create($fileName = null);

    public function chmod($permissions = 0755);

    public function open($fileName = null, $mode = "a");

    public function filesize();

    public function write($data = null);

    public function read($bytes = 1024);

    public function close();

    public function delete();

  }

  /*
  --------------------------------------------------------------------------------
  |                                    File class                                |
  --------------------------------------------------------------------------------
  */

  class File implements \FileInterface
  {

    /*
    --------------------------------------------------------------------------------
    |                              File Static Variables                           |
    --------------------------------------------------------------------------------
    */

    static $self = null;

    static $fileName = null;

    /*
    --------------------------------------------------------------------------------
    |                            File getInstance Function                         |
    --------------------------------------------------------------------------------
    */

    public function getInstance()
    {

      if(isset(self::$self))
      {

        return self::$self;

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                            File getfileName Function                         |
    --------------------------------------------------------------------------------
    */

    public function getfileName()
    {

      if(isset(self::$fileName))
      {

        return self::$fileName;

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                            File setfileName Function                         |
    --------------------------------------------------------------------------------
    */

    public function setfileName($newfileName = null)
    {

      if(!(isset($newfileName)))
      {

        throw new \FileException("All argument(s) parsed to File::setfileName must not be null.");

      }
      else
      {

        return self::$fileName = $newfileName;

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                              File create Function                            |
    --------------------------------------------------------------------------------
    */

    public function create($fileName = null)
    {

      if(!(isset($fileName)))
      {

        throw new \FileException("All argument(s) parsed to File::create must not be null.");

      }
      else
      {

        $fp = @touch($fileName);

        if(!($fp))
        {

          throw new \FileException("Could not create the specified file.");

        }
        else
        {

          return $fp;

        }

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                              File chmod Function                             |
    --------------------------------------------------------------------------------
    */

    public function chmod($permissions = 0755)
    {

      if(!(isset($permissions)))
      {

        throw new \FileException("All argument(s) parsed to File::chmod must not be null.");

      }
      else
      {

        if($this->getInstance() === null)
        {

          throw new \FileException("You must first open a file(using File::open) before trying to chmod a file.");

        }
        else
        {

          $fp = @chmod($this->getfileName(), $permissions);

          if(!($fp))
          {

            throw new \FileException("Could not chmod the specified file.");

          }
          else
          {

            return $chmod;

          }

        }

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                                File open Function                            |
    --------------------------------------------------------------------------------
    */

    public function open($fileName = null, $mode = "a")
    {

      if(!(isset($fileName)) or (!(isset($mode))))
      {

        throw new \FileException("All argument(s) parsed to File::open must not be null.");

      }
      else
      {

        $fp = @fopen($fileName, $mode);

        if($fp)
        {

          self::$self = $fp;

          $this->setfileName($fileName);

        }
        else
        {

          throw new \FileException("Could not open the specified file with the specified mode. Does the file exist?");

        }

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                             File filesize Function                           |
    --------------------------------------------------------------------------------
    */

    public function filesize()
    {

      if($this->getInstance() === null)
      {

        throw new \FileException("You must first open a file(using File::open) before trying to get the filesize of a file.");

      }
      else
      {

        $mod = 1024;

        $size = filesize($this->getfileName());

        $units = explode(' ','Bytes KB MB GB TB PB');

        for ($i = 0; $size > $mod; $i++) 
        {

          $size /= $mod;

        }

        return round($size, 2) . ' ' . $units[$i];

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                              File write Function                             |
    --------------------------------------------------------------------------------
    */

    public function write($data = null)
    {

      if(!(isset($data)))
      {

        throw new \FileException("All argument(s) parsed to File::write must not be null.");

      }
      else
      {

        if($this->getInstance() === null)
        {

          throw new \FileException("You must first open a file(using File::open) before trying to write to a file.");

        }
        else
        {

          $fp = @fwrite($this->getInstance(), $data);

          if(!(fp))
          {

            throw new \FileException("Could not write to the specified file.");

          }
          else
          {

            return $fp;

          }

        }

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                               File read Function                             |
    --------------------------------------------------------------------------------
    */

    public function read($bytes = 1024)
    {

      if(!(isset($bytes)))
      {

        throw new \FileException("All argument(s) parsed to File::read must not be null.");

      }
      else
      {

        if($this->getInstance() === null)
        {

          throw new \FileException("You must first open a file(using File::open) before trying to read a file.");

        }
        else
        {

          $fp = @file_get_contents($this->getfileName());

          if(!($fp))
          {

            throw new \FileException("Could not read the specified file.");

          }
          else
          {

            return $fp;

          }

        }

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                              File close Function                             |
    --------------------------------------------------------------------------------
    */

    public function close()
    {

      if($this->getInstance() === null)
      {

        throw new \FileException("You must first open a file(using File::open) before trying to close a file.");

      }
      else
      {

        $fp = @fclose($this->getInstance());

        if(!($fp))
        {

          throw new \FileException("Could not close the specified file.");

        }
        else
        {

          return $fp;

        }

      }

    }

    /*
    --------------------------------------------------------------------------------
    |                               File delete Function                           |
    --------------------------------------------------------------------------------
    */

    public function delete()
    {

      if($this->getInstance() === null)
      {

        throw new \FileException("You must first open a file(using File::open) before trying to delete a file.");

      }
      else
      {

        $fp = @unlink($this->getfileName());

        if(!($fp))
        {

          throw new \FileException("Could not delete the specified file.");

        }
        else
        {

          return $fp;

        }

      }

    }

  }

?>
