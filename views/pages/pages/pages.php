

<div class="card card-body mx-3 mx-md-4 mt-n6" style="margin-top: 0px !important">
    <div class="row">
        <?php
            if(isset($_GET['id'])){
                include 'actions/edition.php';
            }else{
                include 'actions/list.php';
            }
        ?>
    </div>
</div>
  