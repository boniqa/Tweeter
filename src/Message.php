<?php

class Message
{
    private $id;
    private $author_id;
    private $user_id;
    private $text;
    private $creation_date;

    public function __construct()
    {
        $this->id = -1;
        $this->author_id= "";
        $this->user_id = "";
        $this->text = "";
        $this->creation_date = "";
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return date
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param date $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    function getAuthor_id() {
        return $this->author_id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getCreation_date() {
        return $this->creation_date;
    }

    function setAuthor_id($author_id) {
        $this->author_id = $author_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setCreation_date($creation_date) {
        $this->creation_date = $creation_date;
    }

        
    
    public function saveToDb(mysqli $conn)
    {
        if ($this->id == -1) {
            $sql = "INSERT INTO Messages (author_id, user_id, text, creation_date)
          VALUES('{$this->author_id}','{$this->user_id}', '{$this->text}', '{$this->creation_date}');";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Messages SET author_id='{$this->author_id}', user_id='{$this->user_id}',
          text='{$this->text}', creation_date='{$this->creation_date}'
          WHERE id={$this->id}";
            $result = $conn->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    static public function loadMessageById(mysqli $conn, $id)
    {
        $sql = "SELECT * FROM Messages WHERE id = $id";

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            $row = $result->fetch_object();

            $loadedMessage = new Message();
            $loadedMessage->id = $row->id;
            $loadedMessage->author_id = $row->author_id;
            $loadedMessage->user_id = $row->user_id;
            $loadedMessage->text = $row->text;
            $loadedMessage->creation_date = $row->creation_date;

            return $loadedMessage;
        }

        return null;
    }
    
     static public function loadMessagesByUserId(mysqli $conn, $user_id)
    {
        $sql = "SELECT * FROM Messages WHERE user_id = $user_id";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->author_id = $row['author_id'];
                $loadedMessage->user_id = $row['user_id'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->creation_date = $row['creation_date'];

                $ret[] = $loadedMessage;
            }
        }

        return $ret;           

    }

     static public function loadMessagesByAuthorId(mysqli $conn, $author_id)
    {
        $sql = "SELECT * FROM Messages WHERE author_id = $author_id";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->author_id = $row['author_id'];
                $loadedMessage->user_id = $row['user_id'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->creation_date = $row['creation_date'];

                $ret[] = $loadedMessage;
            }
        }

        return $ret;           

    }

    public function delete(mysqli $conn)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM Tweets WHERE id =  $this->id";

            $result = $conn->query($sql);

            if ($result == true) {
                $this->id = -1;
                return true;
            }

            return false;
        }

        return true;
    }
       
}