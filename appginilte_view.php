<?php
define("PREPEND_PATH", "");
$hooks_dir = dirname(__FILE__);
include("defaultLang.php");
include("language.php");
include("lib.php");
include 'appginilte_header.php';
$page = $_REQUEST['page'];
$page_title = substr($page, 0, strpos($page, ".php"));
if (strpos($page_title, "_view")) {
    # code...
    $rtrim_page_title = preg_replace('/_view$/', '', $page_title);
    $json = json_encode(get_tables_info(true));
    $decode = json_decode($json,true);
   $page_title = $decode[$rtrim_page_title]['Caption'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo APP_TITLE; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo ucwords(str_replace("_", " ", $page_title)); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="col-lg-12">
            <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-eye"></i>
                            <?php echo ucwords(str_replace("_", " ", $page_title)); ?>
                        </h3>
                    </div>
                    <div class="card-body">
                    <iframe class="responsive-iframe" src="<?php echo $page; ?>" id="child-iframe" scrolling="no"></iframe>
                    </div>
                <script>
                    let iframe = document.querySelector("#child-iframe");
                    iframe.addEventListener('load', function() {
                        setInterval(function() {
                            var height = iframe.contentDocument.body.scrollHeight;
                            var width = iframe.contentDocument.body.scrollWidth;
                            if (height == 0) {
                                iframe.style.height = '900px';
                            } else {
                                iframe.style.height = height + 'px';
                            }
                            iframe.style.width = width + 'px';
                        }, 100);
                    });
                </script>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'appginilte_footer.php'; ?>