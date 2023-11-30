<?php
require_once 'Database.php';

class User extends Database {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
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
        if (is_numeric($firstName) || $firstName === '') {
            throw new Exception ('Votre Prénom est obligatoire.');
        }
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
        if (is_numeric($lastName) || $lastName === '') {
            throw new Exception ('Votre nom est obligatoire.');
        }
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get the value of phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber(): string{
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): self {
        if (!is_numeric($phoneNumber) || ($phoneNumber !== '' && strlen($phoneNumber) != 10 )){
            throw new Exception ('Votre numéro de téléphone n\'est pas au format souhaité.');
            die;
        }
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
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception ('Votre adresse email n\'est pas valide.');    
        }
        $allUserEmail = $this->getAllEmail();
        if (in_array($email, $allUserEmail)) {
            throw new Exception ('Compte existant');
        }
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
    public function setPassword(string $password, string $verifyPassword): self {
        if ($password !== $verifyPassword) {
            throw new Exception ('Vos mots de passe sont différent');
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;
        return $this;
    }

    
    // METHODS

    public function initialiseUser(string $firstname, string $lastname, string $email, string $password,string $verifyPassword, string $phoneNumber):void {
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
        $statement->bindValue(':phoneNumber', $this->getPhoneNumber(), \PDO::PARAM_STR);
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
        if (empty($user)) {
            throw new Exception ("Email ou mot de passe invalide");
        }
        $passwordHash = $user['password'];
        if (password_verify($password, $passwordHash)) {
            return $user;
        }
        throw new Exception ("Email ou mot de passe invalide");
    }

    public function getAllEmail(): array {
        $query = "SELECT email FROM user ";
        $statement = $this->getPdo()->query($query);
        $user = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $user;
    }

}