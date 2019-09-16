<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <?php 
        $var = get_search_query();
        if ($var === ""){
            $var = "Cerca...";
        }
        ?>
        <input type="text" value="" name="s" id="s" placeholder="<?php echo $var ?>">
    </div>
</form>