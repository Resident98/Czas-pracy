<?php

class User {
    /** @var object Przechowuje obiekt klasy MySQLi **/
    protected $db;

    /**
     * Najbanalniejsza implementacja Dependency Injection, co by uniknąć globali
     *
     * @param object Obiekt klasy MySQLi
     * @return void
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Zwraca tablicę ze wszystkimi danymi o użytkowniku.
     *
     * @param int $userID ID określonego użytkownika; jeżeli pominięte to obecnie zalogowany
     * @return array
     */
    public function data($userID = null)
    {
        if ($userID === null) {
            $userID = $_SESSION['user_id'];
        }

        $userID = intval($userID);

        return $this->db->query("SELECT * FROM users WHERE id = $userID")->fetch_assoc();
    }

    /**
     * Sprawdza czy użytkownik jest zalogowany
     *
     * @return bool
     */
    public function check()
    {
        return isset($_SESSION['user_id']);
    }


    /**
     * Sprawdza czy istnieje użytkownik o podanych danych
     *
     * @param string $login Podany login użytkownika
     * @param string $password Podane hasło użytkownika (plaintext)
     * @return bool|int Zwraca ID zalogowanego użytkownika lub false
     */
    public function auth($login, $password)
    {
        $login = $this->db->real_escape_string($login);
        $tmp = $this->db->query("SELECT id, password FROM users WHERE login = '$login'");

        if (!$tmp->num_rows) {
            return false;
        }

        $userData = $tmp->fetch_assoc();

        if (password_verify($password, $userData['password'])) {
            return $userData['id'];
        } else {
            return false;
        }
    }
}