

<div class="card card-body mx-3 mx-md-4 mt-n6" style="margin-top: 0px !important">
    <div class="row">
        <?php
            if(isset($_GET['edition'])){
                include 'actions/edition.php';
            }else if(isset($_GET['roles'])){
                include 'actions/roles.php';
            }else{
                include 'actions/list.php';
            }
        ?>
    </div>
</div>
  