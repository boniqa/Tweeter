<?php

class Comment
{
        
    private $id;
    private $user_id;
    private $post_id;
    private $creation_date;
    private $text;

    public function __construct()
    {
        $this->id = -1;
        $this->user_id = "";
        $this->post_id = "";
        $this->creation_date = "";
        $this->text = "";
    }
    function getUser_id() {
        return $this->user_id;
    }

    function getPost_id() {
        return $this->post_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
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
            $sql = "INSERT INTO Comments(user_id, post_id, creation_date, text)
          VALUES('{$this->user_id}', '{$this->post_id}', '{$this->creation_date}', '{$this->text}');";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Comments SET user_id='{$this->user_id}', post_id='{$this->post_id}',
          creation_date='{$this->creation_date}', text='{$this->text}'
          WHERE id={$this->id}";
            $result = $conn->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    static public function loadCommentById(mysqli $conn, $id)
    {
        $sql = "SELECT * FROM Comments WHERE id = $id";

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            $row = $result->fetch_object();

            $loadedComment = new Comment();
            $loadedComment->id = $row->id;
            $loadedComment->user_id = $row->user_id;
            $loadedComment->post_id = $row->post_id;
            $loadedComment->text = $row->text;
            $loadedComment->creation_date = $row->creation_date;

            return $loadedComment;
        }

        return null;
    }
    
     static public function loadAllCommentsByPostId(mysqli $conn, $post_id)
    {
        $sql = "SELECT * FROM Comments WHERE post_id = $post_id";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->user_id = $row['user_id'];
                $loadedComment->post_id = $row['post_id'];
                $loadedComment->text = $row['text'];
                $loadedComment->creation_date = $row['creation_date'];

                $ret[] = $loadedComment;
            }
        }

        return $ret;           

    }
    
}