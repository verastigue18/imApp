<?php 

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ];


        $stmt->execute($params);
    }

    public function isUsernameTaken($username) {
        $query = "SELECT COUNT(*) as count FROM users WHERE username = :username";
        $stmt = $this->db->conn->prepare($query);

        $params = [':username' => $username];

        $result = $stmt->execute($params);

        if (is_array($result) && isset($result['count'])) {
            return $result['count'] > 0;
        } else {
            return false;
        }
    }

    public function isEmailTaken($email) {
        $query = "SELECT COUNT(*) as count FROM users WHERE email = :email";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':email' => $email,
        ];

        $result = $stmt->execute($params);

        return $result['count'] > 0;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE TRIM(username) = :username";
        $stmt = $this->db->conn->prepare($query);

        $params = [':username' => $username];

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user !== false) {
          
            if (isset($user['password']) && password_verify($password, $user['password'])) {
                // LOGIN SUCCESS
                return $user;
            } else {
                // INCORRECT PASSWORD
                return false;
            }
        } else {
            // USER NOT FOUND
            return false;
        }        
    }


    public function getUserById($user_id) {
        $query = "SELECT * FROM users WHERE id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $user_id];

        $stmt->execute($params);

        return $stmt->fetch();
    }
}