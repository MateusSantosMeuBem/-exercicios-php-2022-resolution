<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

/**
 * Defines a class that'll scrap a HTML document.
 */
interface ScrapperInterface {
    /**
     * Scraps a HTML document
     * 
     * @var \DOMDocument $dom
     *  HTML document to be scraped.
     * 
     * @return array
     *  First element is the header to the spreadsheet and the
     *  second one is data content.
     * 
     */
    public function scrap(\DOMDocument $dom): mixed;
}