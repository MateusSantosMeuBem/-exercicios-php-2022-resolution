<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;


/**
 * 
 * 
 */
class Writer implements WriterInterface{

  /**
   * 
   * 
   */
  public function write(array $headerKeys, array $data): void {
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToFile(__DIR__.'/model.xlsx');

    $style = (new StyleBuilder())->setFontBold()->build();
    $row = WriterEntityFactory::createRowFromArray($headerKeys);
    $row->setStyle($style);
    $writer->addRow($row);
    $writer->addRows($data);
    $writer->close();
  }
}