<?php
/**
 * SimpleDebug collects all your debug events, bundles and formats them and provides them in different ways.
 * @author: Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2012-10-18
 * @copyright (c) 2012, Lukas Kolletzki
 */

class simpleDebug{
    private $events = array();
    private $output;
    
    /**
     * Adds an debug event
     * @param string $identifier
     * @param string $text
     */
    public function addEvent($identifier, $text) {
        $this->events[$identifier] = $text;
    }
    
    /**
     * Delivers all events
     * @param bool $format
     * @return string if events should be formated, else array
     */
    public function getEvents($format = false){
        if($format){
            $this->formatEvents();
            return $this->output;
        } else {
            return $this->events;
        }
    }

    /**
     * Format all events in a table
     * @param array $events
     */
    public function formatEvents($events = NULL){
        if(empty($events)){
            $events = $this->events;
        }
        
        $this->output = '<table>';
        $this->output .= '<tr class="thead"><td>ID</td><td>Identifier</td><td>Text</td>';
        
        $i = 1;
        foreach ($events as $key => $value) {
            $this->output .= '<tr class="trcolor';
            if($i % 2 == 0){
                $this->output .= '1"';
            } else {
                $this->output .= '2"';
            }
            $this->output .= '><td>#' . $i . '</td>'; 
            $this->output .= '<td>' . $key . ':</td>';
            $this->output .= '<td>' . $value . '</td>';
            $this->output .= '</tr>';
            $i++;
        }
        
        $this->output .= '</table>';
    }
    
    
}
?>
