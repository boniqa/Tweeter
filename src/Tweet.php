<?php

class Tweet
{
    private $id;
    private $user_id;
    private $text;
    private $creation_date;

    public function __construct()
    {
        $this->id = -1;
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
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
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

    
    
    
    public function saveToDb(mysqli $conn)
    {
        if ($this->id == -1) {
            $sql = "INSERT INTO Tweets(user_id, text, creation_date)
          VALUES('{$this->user_id}', '{$this->text}', '{$this->creation_date}');";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Tweets SET user_id='{$this->user_id}',
          text='{$this->text}', creation_date='{$this->creation_date}'
          WHERE id={$this->id}";
            $result = $conn->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    static public function loadTweetById(mysqli $conn, $id)
    {
        $sql = "SELECT * FROM Tweets WHERE id = $id";

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            $row = $result->fetch_object();

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row->id;
            $loadedTweet->user_id = $row->user_id;
            $loadedTweet->text = $row->text;
            $loadedTweet->creation_date = $row->creation_date;

            return $loadedTweet;
        }

        return null;
    }
    
     static public function loadTweetByUserId(mysqli $conn, $user_id)
    {
        $sql = "SELECT * FROM Tweets WHERE user_id = $user_id";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->user_id = $row['user_id'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creation_date = $row['creation_date'];

                $ret[] = $loadedTweet;
            }
        }

        return $ret;           

    }

    static public function loadAllTweets(mysqli $conn)
    {
        $sql = "SELECT * FROM Tweets ORDER BY creation_date DESC";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->user_id = $row['user_id'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creation_date = $row['creation_date'];

                $ret[] = $loadedTweet;
            }
        }

        return $ret;
    }

    public function delete(mysqli $conn)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM Tweets WHERE id = " . $this->id;

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