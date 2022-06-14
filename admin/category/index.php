<?php require_once('../header.php') ?>
<section id="main-content">
    <section class="wrapper">
    <?php include('../custom_lib/template/search_form.php') ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="box-shadow: 0 0 0;">
            <div class="card-body">
                <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 카테고리 관리</h4>
                <p class="card-description"> <code></code> </p>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th> 카테고리명 </th>
                        <th> 내부 아이템 </th>
                        <th> 상세 보기 </th>
                    </tr>
                </thead>
                <tbody class="result">
                    <?php echo getCteOptionTag(); ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </section>
</section>
    

<?php require_once('../footer.php') ?>