<?php

/**
 * SimpleDebug offers several debugging methods like events or time measurement and offers them bundled in different ways
 * @author: Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-03-30
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
class simpleDebug {
    private $listener = array();

    private $events = array();
    private $output;

    private $timeStart;
    private $timeSections = array();
    private $timeEnd;

    /**
     * adds a listener
     * @param string $identifier name of event
     * @param string $callback callback of listener
     */
    public function addListener($identifier, $callback) {
        $this->listener[$identifier] = $callback;
    }

    /**
     * adds an debug event
     * @param string $identifier name of event
     * @param string $text value of event
     */
    public function addEvent($identifier, $text) {
        $this->events[$identifier] = $text;

        if(isset($this->listener[$identifier])) {
    		$this->listener[$identifier]($text);
        }
    }

    /**
     * delivers all events
     * @param bool $format all events can be formated in a table ($this->formatEvents())
     * @return string if events should be formated, else array
     */
    public function getEvents($format = false) {
        if ($format) {
            $this->formatEvents();
            return $this->output;
        } else {
            return $this->events;
        }
    }

    /**
     * counts all events
     * @return int number of events
     */
    public function countEvents() {
        return count($this->events);
    }

    /**
     * format all events in a table
     * @param array $events event array
     */
    public function formatEvents($events = NULL) {
        //if no array supplied, use intern array
        if (empty($events)) {
            $events = $this->events;
        }

        //table head
        $this->output = '<table>';
        $this->output .= '<tr class="thead"><td>ID</td><td>Identifier</td><td>Text</td>';

        //create row for each event
        $i = 1;
        foreach ($events as $key => $value) {
            $this->output .= '<tr class="trcolor';

            //choose background color
            if ($i % 2 == 0) {
                $this->output .= '1"';
            } else {
                $this->output .= '2"';
            }

            //put data
            $this->output .= '><td>#' . $i . '</td>';
            $this->output .= '<td>' . $key . ':</td>';
            $this->output .= '<td>' . $value . '</td>';
            $this->output .= '</tr>';
            $i++;
        }

        $this->output .= '</table>';
    }

    /**
     * sets start time
     */
    public function startTime() {
        $this->timeStart = microtime(true);
    }

    /**
     * sets a section time
     */
    public function addSection() {
        $this->timeSections[] = microtime(true);
    }

    /**
     * sets end time
     */
    public function endTime() {
        $this->timeEnd = microtime(true);
    }

    /**
     * get all calculated, rounded and raw times in one array
     * @param int $roundPrecision number of digits after decimal point for rounded values
     * @return mixed false if error, else array with data
     */
    public function getTimes($roundPrecision = 5) {
        $result = array();
        //if no end is given, set last section as end, else cancel method and return false
        if (!isset($this->timeEnd) || empty($this->timeEnd)) {
            if (count($this->timeSections) > 0) {
                $this->timeEnd = end($this->timeSections);
            } else {
                return false;
            }
        }

        //put all raw data into array
        $result['start'] = $this->timeStart;
        $result['end'] = $this->timeEnd;
        $result['allSections'] = $this->timeSections;

        //calc and put full time without sections into array
        $result['full'] = array();
        $result['full']['float'] = $this->timeEnd - $this->timeStart;
        $result['full']['round'] = round($result['full']['float'], $roundPrecision);


        //calc and put all sections into array
        $result['section'] = array();
        foreach ($this->timeSections as $id => $time) {
            $result['section'][$id] = array();
            $result['section'][$id]['start'] = $this->timeStart();
            $result['section'][$id]['end'] = $time;
            $result['section'][$id]['time'] = $time - $this->timeStart;
            $result['section'][$id]['round'] = round($result['section'][$id][$time], $roundPrecision);
        }

        return $result;
    }

}

?>
