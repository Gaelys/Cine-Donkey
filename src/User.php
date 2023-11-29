<?php
require_once 'Database.php';

class User extends Database {
    private int $id;
    private string $firstName;
    private string $lastName;
    private int $phoneNumber;
    private string $email;
    private string $password;

    
    //GETTERS AND SETTERS

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of firstName
     *
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName(string $firstName): self {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param string $lastName
     *
     * @return self
     */
    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get the value of phoneNumber
     *
     * @return INT
     */
    public function getPhoneNumber(): INT {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @param INT $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(INT $phoneNumber): self {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    

    
    
    // METHODS

    public function setPassword(string $password, string $verifyPassword): self {
        if ($password !== $verifyPassword) {
            throw new Exception ('Vos mots de passe sont différent');
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;
        return $this;
    }

    public function initialiseUser(string $firstname, string $lastname, string $email, string $password,string $verifyPassword, int $phoneNumber):void {
        $this->setFirstName($firstname);
        $this->setLastName($lastname);
        $this->setEmail($email);
        $this->setPassword($password, $verifyPassword);
        $this->setPhoneNumber($phoneNumber);
    }

    public function insertUser():void {
        $query = "INSERT INTO user(firstname, lastname, phoneNumber, email, `password`) VALUES (:firstname, :lastname, :phoneNumber, :email, :password)";
        $statement = $this->getPdo()->prepare($query);
        $statement->bindValue(':firstname', $this->getFirstname(), \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->getLastname(), \PDO::PARAM_STR);
        $statement->bindValue(':phoneNumber', $this->getPhoneNumber(), \PDO::PARAM_INT);
        $statement->bindValue(':email', $this->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':password', $this->getPassword(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function getUser(string $email, string $password): array {
        $query = "SELECT * FROM user WHERE email = :email";
        $statement = $this->getPdo()->prepare($query);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $passwordHash = $user['password'];
        if (password_verify($password, $passwordHash)) {
            return $user;
        }
    }

}