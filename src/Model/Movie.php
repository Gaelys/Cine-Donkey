<?php

class Movie {
    private INT $id;
    private string $title;
    private string $summary;
    private string $age_rating;
    private string $startShowDate;
    private float $price;
    private string $imagePath;
    

    /**
     * Get the value of id
     *
     * @return INT
     */
    public function getId(): INT {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param INT $id
     *
     * @return self
     */
    public function setId(INT $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of summary
     *
     * @return string
     */
    public function getSummary(): string {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @param string $summary
     *
     * @return self
     */
    public function setSummary(string $summary): self {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get the value of age_rating
     *
     * @return string
     */
    public function getAgeRating(): string {
        return $this->age_rating;
    }

    /**
     * Set the value of age_rating
     *
     * @param string $age_rating
     *
     * @return self
     */
    public function setAgeRating(string $age_rating): self {
        $this->age_rating = $age_rating;
        return $this;
    }

    /**
     * Get the value of startShowDate
     *
     * @return string
     */
    public function getStartShowDate(): string {
        return $this->startShowDate;
    }

    /**
     * Set the value of startShowDate
     *
     * @param string $startShowDate
     *
     * @return self
     */
    public function setStartShowDate(string $startShowDate): self {
        $this->startShowDate = $startShowDate;
        return $this;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice(): float {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price): self {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of imagePath
     *
     * @return string
     */
    public function getImagePath(): string {
        return $this->imagePath;
    }

    /**
     * Set the value of imagePath
     *
     * @param string $imagePath
     *
     * @return self
     */
    public function setImagePath(string $imagePath): self {
        $this->imagePath = $imagePath;
        return $this;
    }
}