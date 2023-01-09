<?php

class paginationArray
{

    /**
     * Properties array
     * @var array   
     * @access private 
     */
    private $_properties = array();

    /**
     * Default configurations
     * @var array  
     * @access public 
     */
    public $_defaults = array(
        'page' => 1,
        'record_per_page' => 10,
        'param'
    );

    /**
     * Constructor
     * 
     * @param array $array   Array of results to be paginated
     * @param int   $current_page The current page interger that should used
     * @param int   $record_per_page The amount of items that should be show per page
     * @return void    
     * @access public  
     */
    public function __construct($array, $current_page = null, $record_per_page = null, $params = null)
    {
        $this->array   = $array;
        $this->current_page = ($current_page == null ? $this->defaults['page'] : $current_page);
        $this->record_per_page = ($record_per_page == null ? $this->defaults['record_per_page'] : $record_per_page);
        $this->params     = $params;
    }

    /**
     * @param string 
     * @param string 
     * @return void    
     * @access public  
     */
    public function __set($name, $value)
    {
        $this->_properties[$name] = $value;
    }

    /**
     * @param string
     * @return mixed
     * @access public  
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_properties)) {
            return $this->_properties[$name];
        }
        return false;
    }

    /**
     * @param boolean 
     * @return void    
     * @access public  
     */
    public function setShowFirstAndLast($showFirstAndLast)
    {
        $this->_showFirstAndLast = $showFirstAndLast;
    }

    /**
     * @param string 
     * @return void    
     * @access public  
     */
    public function setMainSeperator($mainSeperator)
    {
        $this->mainSeperator = $mainSeperator;
    }

    /**
     * @return array 
     * @access public 
     */
    public function getResults()
    {
        if (empty($this->current_page) !== false) {
            $this->page = $this->current_page;
        } else {
            $this->page = 1;
        }
        $this->length = count($this->array);
        $this->pages = ceil($this->length / $this->record_per_page);
        $this->start = ceil(($this->page - 1) * $this->record_per_page);
        return array_slice($this->array, $this->start, $this->record_per_page);
    }
    /**
     * @return buider string query
     * @access public 
     */
    public function buildQuery()
    {
        $qs = '';
        if (!empty($_SERVER['QUERY_STRING'])) {
            $parts = explode("&", $_SERVER['QUERY_STRING']);
            $query_array = array();
            foreach ($parts as $val) {
                if (stristr($val, 'page') == false) {
                    array_push($query_array, $val);
                }
            }
            if (count($query_array) != 0) {
                $qs = "&" . implode("&", $query_array);
            }
        }
        return $qs;
    }
    /**
     * @param array 
     * @return mixed  
     * @access public 
     */
    public function getLinks($link)
    {
        $plinks = array();
        $links = array();
        $slinks = array();
        $queryUrl = $this->buildQuery();
        if (($this->pages) > 1) {
            if ($this->page != 1) {
                if ($this->_showFirstAndLast) {
                    $plinks[] = ' <a rel="nofollow" href="' . $link . '/?page=1' . $queryUrl . '">&laquo;&laquo;</a> ';
                }
                $plinks[] = ' <a rel="nofollow" href="' . $link . '/?page=' . ($this->page - 1) . $queryUrl . '" class="prev">&laquo;</a> ';
            }
            for ($j = 1; $j < ($this->pages + 1); $j++) {
                if ($this->page == $j) {
                    $links[] = ' <a rel="nofollow" class="current">' . $j . '</a> ';
                } else {
                    $links[] = ' <a rel="nofollow" href="' . $link . '/?page=' . $j . $queryUrl . '">' . $j . '</a> ';
                }
            }

            if ($this->page < $this->pages) {
                $slinks[] = ' <a rel="nofollow" href="' . $link . '/?page=' . ($this->page + 1) . $queryUrl . '" class="next">&raquo;</a> ';
                if ($this->_showFirstAndLast) {
                    $slinks[] = ' <a rel="nofollow" href="' . $link . '?page=' . ($this->pages) . $queryUrl . '">&raquo;&raquo; </a> ';
                }
            }

            return implode(' ', $plinks) . implode($this->mainSeperator, $links) . implode(' ', $slinks);
        }
        return;
    }
}
