<?php

class Pagination{
   var $baseURL = ''; 
   var $perPage = 10;
   var $numLinks = 3;
   var $currentPage = 0;
   var $totalRows = '';
   var $showCount = true;
   var $currentOffset = 0;
   var $firstLink      = '&lsaquo; First'; 
   var $nextLink       = '&gt;'; 
   var $prevLink       = '&lt;'; 
   var $lastLink       = 'Last &rsaquo;'; 
   var $fullTagOpen    = '<div class="pagination">'; 
   var $fullTagClose   = '</div>'; 
   var $firstTagOpen   = ''; 
   var $firstTagClose  = '&nbsp;'; 
   var $lastTagOpen    = '&nbsp;'; 
   var $lastTagClose   = ''; 
   var $curTagOpen     = '&nbsp;<b>'; 
   var $curTagClose    = '</b>'; 
   var $nextTagOpen    = '&nbsp;'; 
   var $nextTagClose   = '&nbsp;'; 
   var $prevTagOpen    = '&nbsp;'; 
   var $prevTagClose   = ''; 
   var $numTagOpen     = '&nbsp;'; 
   var $numTagClose    = ''; 
   var $anchorClass    = ''; 
   var $contentDiv     = ''; 
   var $additionalParam= ''; 
   var $link_func      = ''; 


    function __construct($params = array()){ 
        if (count($params) > 0){ 
            $this->initialize($params);         
        } 
         
        if ($this->anchorClass != ''){ 
            $this->anchorClass = 'class="'.$this->anchorClass.'" '; 
        }     
    } 
     
    function initialize($params = array()){ 
        if (count($params) > 0){ 
            foreach ($params as $key => $val){ 
                if (isset($this->$key)){ 
                    $this->$key = $val; 
                } 
            }         
        } 
    } 


    function createLinks(){


        if($totalRows==0 || $perPage ==0){
            return '';
        }
        $numPages = $totalRows/$perPage;

        if($numPages==1){
            if($showCount){
                return "Showing: "+$totalRows;
            }
            else{
                return '';
            }
        }
        if(!is_numeric($currentPage)){
            $currentPage=0;
        }
        $output = '';

        if($showCount){
        $currentOffset = $currentPage;
        $info = 'Showing ' . ( $currentOffset + 1 ) . ' to ' ; 

            if($currentPage+$perPage<$totalRows){
                $info .= $currentOffset + $perPage;   
            }
            else {
                $info .= $totalRows; 
            }
            $info .= ' of ' . $totalRows . ' | '; 
            $output .= $info; 
        }

        $numLinks = (int)$numLinks; 

        if ($currentPage > $totalRows){ 
            $currentPage = ($numPages - 1) * $perPage; 
        } 
        
        $uriPageNum = $currentPage; 
        
        $currentPage = floor(($currentPage/$perPage) + 1); 

        $start = (($currentPage - $numLinks) > 0) ? $currentPage - ($numLinks - 1) : 1; 
        $end   = (($currentPage + $numLinks) < $numPages) ? $currentPage + $numLinks : $numPages; 

        if  ($this->currentPage > $this->numLinks){ 
            $output .= $this->firstTagOpen  
                . $this->getAJAXlink( '' , $this->firstLink) 
                . $this->firstTagClose;  
        } 

        // Render the "previous" link 
        if  ($currentPage != 1){ 
            $i = $uriPageNum - $tperPage; 
            if ($i == 0) $i = ''; 
            $output .= $prevTagOpen  
                . getAJAXlink( $i, $prevLink ) 
                . $prevTagClose; 
        }

        // Write the digit links 
        for ($loop = $start -1; $loop <= $end; $loop++){ 
            $i = ($loop * $perPage) - $perPage; 
                    
            if ($i >= 0){ 
                if ($currentPage == $loop){ 
                    $output .= $curTagOpen.$loop.$curTagClose; 
                }else{ 
                    $n = ($i == 0) ? '' : $i; 
                    $output .= $numTagOpen 
                        . getAJAXlink( $n, $loop ) 
                        . $numTagClose; 
                } 
            } 
        } 

        // Render the "next" link 
        if ($currentPage < $numPages){ 
            $output .= $nextTagOpen  
                . getAJAXlink( $currentPage * $perPage , $nextLink ) 
                . $nextTagClose; 
        } 

        // Render the "Last" link 
        if (($currentPage + $numLinks) < $numPages){ 
            $i = (($numPages * $perPage) - $perPage); 
            $output .= $lastTagOpen . $getAJAXlink( $i, $lastLink ) . $lastTagClose; 
        } 

        // Remove double slashes 
        $output = preg_replace("#([^:])//+#", "\\1/", $output); 

        // Add the wrapper HTML if exists 
        $output = $fullTagOpen.$output.$fullTagClose; 
        
        return $output;    

        function getAJAXlink( $count, $text) { 
            if($link_func == '' && $contentDiv == '') 
                return '<a href="'.$baseURL.'?'.$count.'"'.$anchorClass.'>'.$text.'</a>'; 
            
            $pageCount = $count?$count:0; 
            if(!empty($link_func)){ 
                $linkClick = 'onclick="'.$link_func.'('.$pageCount.')"'; 
            }else{ 
                $additionalParam = "{'page' : $pageCount}"; 
                $linkClick = "onclick=\"$.post('". $baseURL."', ". $additionalParam .", function(data){ 
                        $('#". $contentDiv . "').html(data); }); return false;\""; 
            } 
            
            return "<a href=\"javascript:void(0);\" " . $anchorClass . " 
                    ". $linkClick .">". $text .'</a>'; 
        } 
    }   
}