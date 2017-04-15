<?php

/*
CREATE TABLE Users (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    username varchar(255) NOT NULL,
    hashed_password varchar(60) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE (email)
);
 */

class User
{
    	public static function login(mysqli $conn, $email, $password) {
		$sql = "SELECT * FROM User WHERE email = '$email'";
		$result = $conn->query($sql);
		if($result->num_rows == 1) {
			$rowUser = $result->fetch_assoc();
			if(password_verify($password, $rowUser['hashedPassword'])) {
				return $rowUser['id'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
    
    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct()
    {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    /**
     * @param string $hashedPassword
     */
    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = password_hash($hashedPassword, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function saveToDb(mysqli $conn)
    {
        if ($this->id === -1) {
            $sql = "INSERT INTO Users(username, email, hashed_password) VALUES ('" .
                $this->username . "', '" . $this->email . "', '" .
                $this->hashedPassword . "')";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = $conn->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Users SET username = '" . $this->username .
                "', email = '" . $this->email .
                "', hashed_password = '" . $this->hashedPassword . "'
                WHERE id = " . $this->id;

            $result = $conn->query($sql);

            if ($result == true) {
                return true;
            }
        }

        return false;
    }

    static public function loadUserById(mysqli $conn, $id)
    {
        $sql = "SELECT * FROM Users WHERE id = $id";

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            $row = $result->fetch_object();

            $loadedUser = new User();
            $loadedUser->id = $row->id;
            $loadedUser->username = $row->username;
            $loadedUser->email = $row->email;
            $loadedUser->hashedPassword = $row->hashed_password;

            return $loadedUser;
        }

        return null;
    }

    static public function loadAllUsers(mysqli $conn)
    {
        $sql = "SELECT * FROM Users";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashedPassword = $row['hashed_password'];

                $ret[] = $loadedUser;
            }
        }

        return $ret;
    }

    public function delete(mysqli $conn)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id = " . $this->id;

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