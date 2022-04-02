<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\Request;

class ArrayOptionFactory
{
    /**
     * Original delimiter.
     *
     * @var String  $delimiter_before
     */
    protected $delimiter_before;

    /**
     * Expected delimiter.
     *
     * @var String  $delimiter_after
     */
    protected $delimiter_after;



    /**
     * Create a new factory instance.
     *
     * @param String  $delimiter
     * @return void
     */
    public function __construct($delimiter_before = null, $delimiter_after = null)
    {
        $this->delimiter_before = $delimiter_before;
        $this->delimiter_after = $delimiter_after;
    }


    /*
    |--------------------------------------------------------------------------
    | Get and Set
    |--------------------------------------------------------------------------
    */

    /**
     * @return String
     */
    public function getDelimiterBefore(): string
    {
        return $this->delimiter_before;
    }

    /**
     * @return String
     */
    public function getDelimiterAfter(): string
    {
        return $this->delimiter_after;
    }

    /**
     * @param String  $delimiter_before
     * @return void
     *
     * @throws TypeError
     */
    public function setDelimiterBefore(string $delimiter_before): void
    {
        $this->delimiter_before = $delimiter_before;
    }

    /**
     * @param String  $delimiter_after
     * @return void
     *
     * @throws TypeError
     */
    public function setDelimiterAfter(string $delimiter_after): void
    {
        $this->delimiter_after = $delimiter_after;
    }


    /*
    |--------------------------------------------------------------------------
    | Transformation
    |--------------------------------------------------------------------------
    */

    /**
     * @param Array  $input
     * @return Array
     *
     * @throws TypeError
     */
    public function transformKey(?array $input): array
    {
        $items = [];
        foreach ($input as $key => $value) {
            $key = str_replace($this->delimiter_before, $this->delimiter_after, $key);
            $items[$key] = $value;
        }

        return $items;
    }

    /**
     * @param Array  $input
     * @return Array
     *
     * @throws TypeError
     */
    public function transformValue(?array $input): array
    {
        $items = [];
        foreach ($input as $item) {
            array_push($items, str_replace($this->delimiter_before, $this->delimiter_after, $item));
        }

        return $items;
    }
}
