<?php


class Car
{
    private int $id = -1;
    private string $manufacturer;
    private int $year;
    private string $color;

    /**
     * Car constructor.
     * @param string $manufacturer
     * @param int $year
     * @param string $color
     */
    public function __construct(string $manufacturer, int $year, string $color)
    {
        $this->setManufacturer($manufacturer);
        $this->setYear($year);
        $this->setColor($color);
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        if (is_string($manufacturer))
            $this->manufacturer = $manufacturer;
        else
            throw new TypeError;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        if (is_numeric($year) && ($year >= 1900 && $year <= 9999))
            $this->year = $year;
        else
            throw new Error("must be a number between 1900 and 9999");
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}