<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;


/**
 * Defines a class that can create and write a spreadsheet.
 * 
 */
class Writer implements WriterInterface{

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
  public function write(array $headerKeys, array $data): void {
    /**
     * Starts, creates and opens a new xlsx file
     */
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToFile(__DIR__.'/model.xlsx');

    /**
     * Creates a style object to be used by a row.
     */
    $style = (new StyleBuilder())->setFontBold()->build();
    /**
     * Creates the header.
     */
    $row = WriterEntityFactory::createRowFromArray($headerKeys);
    /**
     * Set the header content as bold weight.
     */
    $row->setStyle($style);
    /**
     * Adds header and data to the spreadsheet.
     */
    $writer->addRow($row);
    $writer->addRows($data);
    
    $writer->close();
  }
}