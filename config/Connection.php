<?php


class Connection extends SQLite3
{
    function __construct()
    {
        try {
            $this->open('data/ponto.db');
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}