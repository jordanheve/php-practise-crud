<?php
   //conect to the database
   function conection(){
       $pdo = new PDO('mysql:host=localhost;dbname=inventario','root','');
        return $pdo;
    }

    //check data
    //returns true if data doesnt match
    function check_data($filter, $string){
        return !preg_match("/^".$filter."$/", $string);
    }
    

    // clean text strings


    function clean_string($string){
        $string = trim($string);
        $string = stripslashes($string);
        $string = str_ireplace("<script>", "", $string);
        $string = str_ireplace("</script>", "", $string);
        $string = str_ireplace("<script src", "", $string);
        $string = str_ireplace("<script type=", "", $string);
        $string = str_ireplace("SELECT * FROM", "", $string);
        $string = str_ireplace("DELETE FROM", "", $string);
        $string = str_ireplace("INSERT INTO", "", $string);
        $string = str_ireplace("DROP TABLE", "", $string);
        $string = str_ireplace("DROP DATABASE", "", $string);
        $string = str_ireplace("TRUNCATE TABLE", "", $string);
        $string = str_ireplace("SHOW TABLES;", "", $string);
        $string = str_ireplace("SHOW DATABASES;", "", $string);
        $string = str_ireplace("<?php", "", $string);
        $string = str_ireplace("?>", "", $string);
        $string = str_ireplace("--", "", $string);
        $string = str_ireplace("^", "", $string);
        $string = str_ireplace("<", "", $string);
        $string = str_ireplace("[", "", $string);
        $string = str_ireplace("]", "", $string);
        $string = str_ireplace("==", "", $string);
        $string = str_ireplace(";", "", $string);
        $string = str_ireplace("::", "", $string);
        $string = trim($string);
        $string = stripslashes($string);
        return $string;
    }

    // rename photos

    function rename_photos($name){
        $name=str_ireplace(" ", "_", $name);
        $name = str_ireplace("/", "_", $name);
        $name = str_ireplace("#", "_", $name);
        $name = str_ireplace("-", "_", $name);
        $name = str_ireplace("$", "_", $name);
        $name = str_ireplace(".", "_", $name);
        $name = str_ireplace(",", "_", $name);
        $name=$name."_".rand(0,100);
        
        return $name;
    }
   
    // pagination

    function paginate_tables($page, $number_pages, $url, $buttons){
        $table = '<nav aria-label="Page navigation"><ul class="pagination">';
        
        
        if ($page <= 1) {
            $table .= '<li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="'.$url.'1">1</a></li>';
        } else {
            $table .= '<li class="page-item">
                            <a class="page-link" href="'.$url.($page - 1).'">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="'.$url.'1">1</a></li>';
        }
    
        
        if ($number_pages > $buttons) {
            $start = max(2, min($page - floor($buttons / 2), $number_pages - $buttons + 1));
            $end = min($start + $buttons - 1, $number_pages - 1);
            
            if ($start > 2) {
                $table .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
            
            for ($i = $start; $i <= $end; $i++) {
                $table .= '<li class="page-item';
                if ($i == $page) {
                    $table .= ' active';
                }
                $table .= '"><a class="page-link" href="'.$url.$i.'">'.$i.'</a></li>';
            }
            
            if ($end < $number_pages - 1) {
                $table .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
        } else {
            for ($i = 2; $i <= $number_pages; $i++) {
                $table .= '<li class="page-item';
                if ($i == $page) {
                    $table .= ' active';
                }
                $table .= '"><a class="page-link" href="'.$url.$i.'">'.$i.'</a></li>';
            }
        }
    
        
        if ($page >= $number_pages) {
            $table .= '<li class="page-item disabled">
                            <a class="page-link">Next</a>
                        </li>';
        } else {
            $table .= '<li class="page-item">
                            <a class="page-link" href="'.$url.($page + 1).'">Next</a>
                        </li>';
        }
    
        $table .= '</ul></nav>';
    
        return $table;
    }
    



?>