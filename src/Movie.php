<?php

class Movie
{
    private string $title;
    private string $summary;
    private string $agerating;
    private string $date;
    private float $startShowDate;
    private string $imagePath;





    public function __construct(string $title, string $summary, string $agerating, string $date, float $startShowDate, string $imagePath)
    {
        $this->title = $title;
        $this->summary = $summary;
        $this->agerating = $agerating;
        $this->date = $date;
        $this->startShowDate = $startShowDate;
        $this->imagePath = $imagePath;
    }


    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of summary
     *
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @param string $summary
     *
     * @return self
     */
    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get the value of agerating
     *
     * @return string
     */
    public function getAgerating(): string
    {
        return $this->agerating;
    }

    /**
     * Set the value of agerating
     *
     * @param string $agerating
     *
     * @return self
     */
    public function setAgerating(string $agerating): self
    {
        $this->agerating = $agerating;
        return $this;
    }

    /**
     * Get the value of date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @param string $date
     *
     * @return self
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the value of startShowDate
     *
     * @return float
     */
    public function getStartShowDate(): float
    {
        return $this->startShowDate;
    }

    /**
     * Set the value of startShowDate
     *
     * @param float $startShowDate
     *
     * @return self
     */
    public function setStartShowDate(float $startShowDate): self
    {
        $this->startShowDate = $startShowDate;
        return $this;
    }

    /**
     * Get the value of imagePath
     *
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * Set the value of imagePath
     *
     * @param string $imagePath
     *
     * @return self
     */
    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }


    // class MovieRepository 
    // {
    //     private $pdo;
    //     public function __construct()
    //     {
    //         $this->pdo=Database::getPdo();
    //     }
}
