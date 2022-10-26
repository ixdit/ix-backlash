<?php
/**
 * @global $args
 */

$backlash =  $_COOKIE['backlash_'.$args]
?>

<section class="ixbl-backlash">
    <div class="ixbl-backlash__wrapper">
        <div class="ixbl-backlash__container">
            <?php
             if ( $backlash == 'like') {
                 ?>
                 <div data-post_id="<?php echo $args ?>" class="ixbl-backlash__item ixbl-backlash__btn ixbl-backlash__btn-like" disabled>
                     <span></span>
                     Вам была полезна статья
                 </div>
                 <?php
             } elseif ( $backlash == 'dislike') {
                 ?>
                 <div data-post_id="<?php echo $args ?>" class="ixbl-backlash__item ixbl-backlash__btn ixbl-backlash__btn-dislike" disabled>
                     <span></span>
                     Вы посчитали статью непонятной
                 </div>
                 <?php
             } else {
                 ?>
                 <a data-post_id="<?php echo $args ?>" data-action="like" class="ixbl-backlash__item ixbl-backlash__btn ixbl-backlash__btn-like" href="#">
                     <span></span>
                     Полезно
                 </a>
                 <a data-post_id="<?php echo $args ?>" data-action="dislike" class="ixbl-backlash__item ixbl-backlash__btn ixbl-backlash__btn-dislike" href="#">
                     <span></span>
                     Непонятно
                 </a>
                 <?php
             }
            ?>

        </div>
    </div>
</section>
