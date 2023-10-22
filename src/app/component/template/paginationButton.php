<!--
    @target
    @is_active
-->
<a href=<?php
    $url = $_SERVER['REQUEST_URI'];

    if(isset($_GET['page'])) $page=$_GET['page'];
    else $page=1;

    if($target==='<'){
        $goto = $page-1;
    } elseif($target==='>'){
        $goto = $page+1;
    } else{
        $goto = $target;
    }

    if(isset($_GET['page'])){
        $url = str_replace('page='.$_GET['page'], 'page='.$goto, $url);
    } else {
        $url = $url . (strpos($url, '?')===false ? '?page='.$goto : '&page='.$goto);
    }
    echo '"'.$url.'"';
?>>
    <div class='button-pagination <?php echo ($is_active ? 'button-red':'button-white')?>' value=<?php echo $goto?>>
        <?php echo $target; ?>
    </div>
</a>