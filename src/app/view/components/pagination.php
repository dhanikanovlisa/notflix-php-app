<!--
    @total_records
    @items_per_page
    @current_page
-->
<div id='pagination-container' class='pagination'>
    <?php
        $totalpages = ceil($total_records/$items_per_page);
        $limitpage = $totalpages<5 ? $totalpages : 5;
        
        $start = ($current_page===1) ? 1 : $current_page-1;
        $bound = $start+$limitpage-1;
        if($bound > $totalpages){
            $start = $totalpages-$limitpage+1;
            $bound = $totalpages;
        }
        if($current_page!=1){
            $target = '<';
            $is_active = false;
            include (DIRECTORY . "/../view/components/paginationButton.php");
        }
        for($i=$start; $i<=$bound; $i++){
            $target = $i;
            $is_active=false;
            if($target==$current_page) $is_active=true;
            include(DIRECTORY . "/../view/components/paginationButton.php");
        }
        if($current_page!=$totalpages && $total_records>0){
            $target = '>';
            $is_active = false;
            include (DIRECTORY . "/../view/components/paginationButton.php");
        }?>
</div>