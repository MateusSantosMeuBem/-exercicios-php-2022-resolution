<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

/**
 * Defines a class that'll create and write a spreadsheet.
 * 
 */
interface WriterInterface{

    /**
     * Write a spreadsheet.
     * The spreedsheet is created in the current directory.
     * 
     * @param array $headerKeys
     *  All the keys for the xlsx docuement.
     * @param array $data
     *  An array with the document rows.
     * 
     */
    public function write(array $headerKeys, array $data): void;
}