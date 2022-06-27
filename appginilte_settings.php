<?php
define("PREPEND_PATH", "");
$hooks_dir = dirname(__FILE__);
include("defaultLang.php");
include("language.php");
include("lib.php");
include 'appginilte_header.php';
if ($group !== "Admins") {
    header('location: index.php');
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
                        <li class="breadcrumb-item active">Settings</li>
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
                            <i class="fas fa-edit"></i>
                            AppginiLTE Settings
                        </h3>
                    </div>
                    <div class="card-body">
                        <h4>Customize The Look And Feel</h4>
                        <p>Use font awesome icons; You can reffer to the <a href="https://itsjavi.com/fontawesome-iconpicker/" target="_blank">Font Awesome Icon Picker</a></p>
                        <p>Dashboard developed using <a href="https://adminlte.io/themes/v3/" target="_blank">AdminLTE Bootstrap Admin Dashboard Template</a></p>
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Table Groups Icons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Table Cards/Menus</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <br>
                                <!-- Show brief explanation details -->
                                <div class="callout callout-info">
                                    <p>Use this section to customize your table groups. You can specifiy the <B>Icon</B> of the table group, to be displayed on the side navigation menu.</p>
                                    <p><b>Home Page Display:</b> This specifies how you want the groups to be displayed on the home page. You can select Collapsible Card (You can toggle collapse the groups) or Default (Groups are not collapsible).</p>
                                    <p><b>Card Color:</b> If you selected Callaspsibe card on the home page display, you will specify the card color here from the list of options provided</p>
                                </div>
                                <!-- explanation -->
                                <form action="" method="POST">
                                    <?php
                                    $groups = get_table_groups();
                                    $cjson = file_get_contents('appginilte/groups_config.json', true);
                                    $cjson = json_decode($cjson, true);
                                    foreach ($groups as $grp => $tables) {
                                        if ($grp !== "None") {
                                            $gn = str_replace(" ", "_", $grp);
                                            $group_fa = $cjson[$gn . '_fa'] ? $cjson[$gn . '_fa'] : 'fa fa-table';
                                            $group_hpd = $cjson[$gn . '_hpd'] ? $cjson[$gn . '_hpd'] : 'default';
                                            $group_cc = $cjson[$gn . '_cc'] ? $cjson[$gn . '_cc'] : 'primary';
                                            echo ' <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                        <label class="text-primary">' . $grp . ' Group Icon: <span class="' . $group_fa . '"></span></label>
                                        <input class="form-control" value="' . $group_fa . '" name="' . $gn . '_fa" type="text" />
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                        <label>Home Page Display</label>
                                        <select id="' . $gn . '_hpd" name="' . $gn . '_hpd" class="form-control">
                                        <option value="default" ' . ($group_hpd == "default" ? 'selected' : '') . '>Default</option>
                                        <option value="collapsible" ' . ($group_hpd == "collapsible" ? 'selected' : '') . '>Collapsible Card</option>
                                        <option value="notgrouped" ' . ($group_hpd == "notgrouped" ? 'selected' : '') . '>Not Grouped</option>
                                        </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                        <label id="' . $gn . '_cclabel">Card Color</label>
                                        <select id="' . $gn . '_cc" name="' . $gn . '_cc" class="form-control"">
                                        <option value="primary" ' . ($group_cc == "primary" ? 'selected' : '') . '>Primary</option>
                                        <option value="success" ' . ($group_cc == "success" ? 'selected' : '') . '>Success</option>
                                        <option value="warning" ' . ($group_cc == "warning" ? 'selected' : '') . '>Warning</option>
                                        <option value="danger" ' . ($group_cc == "danger" ? 'selected' : '') . '>Danger</option>
                                        <option value="info" ' . ($group_cc == "info" ? 'selected' : '') . '>Info</option>
                                        <option value="secondary" ' . ($group_cc == "secondary" ? 'selected' : '') . '>Secondary</option>
                                        </select>
                                        </div>
                                        </div><hr>
                                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                                        <script type="text/javascript">
                                        var ' . $gn . '_hpd = document.getElementById("' . $gn . '_hpd");
                                        var ' . $gn . '_cclabel = document.getElementById("' . $gn . '_cclabel");
                                        var ' . $gn . '_cc = document.getElementById("' . $gn . '_cc");
                                        var selectedDisplay = ' . $gn . '_hpd.options[' . $gn . '_hpd.selectedIndex].value; 
                                        if(selectedDisplay==="default" ||selectedDisplay==="notgrouped"){' . $gn . '_cclabel.style.display = "none";' . $gn . '_cc.style.display = "none";}
                                        if(selectedDisplay==="collapsible"){' . $gn . '_cclabel.style.display = "block";' . $gn . '_cc.style.display = "block";}
                                        $("#' . $gn . '_hpd").change(function(){
                                            var TheselectedDisplay=$("#' . $gn . '_hpd").val();
                                            if(TheselectedDisplay==="default" || TheselectedDisplay==="notgrouped"){' . $gn . '_cclabel.style.display = "none";' . $gn . '_cc.style.display = "none";}
                                        if(TheselectedDisplay==="collapsible"){' . $gn . '_cclabel.style.display = "block";' . $gn . '_cc.style.display = "block";}
                                          });
                                        </script>
                                        ';
                                        }
                                    }
                                    ?>
                                    <br><button type="submit" class="btn btn-primary" name="tblgrps">Save Changes</button>
                                </form>


                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <br>
                                <!-- Show brief explanation details -->
                                <div class="callout callout-info">
                                    <p>Use this section to customize your tables: cards/menus. You can specifiy the <B>Card Color</B> of the table card, to be displayed on the home page.</p>
                                    <p><b>Card Icon:</b> Select on the list which icon your table card will use: Either Default Appgini Icon or Font Awesome Icon.</p>
                                    <p><b>Hide In Home Page:</b> You can specify here user group names(separated by a comma if more than one). This groups will not be able to see the table card on the home page</p>
                                    <p><b>Hide In Nav Menu:</b> You can specify here user group names(separated by a comma if more than one). This groups will not be able to see the table menu on the side navigation menu</p>
                                    <p><b>Font Awesome Icon:</b> If you specified the card icon as Font Awesome Icon you will provide there the icon name eg: fa fa-user</p>
                                </div>
                                <!-- explanation -->
                                <form action="" method="POST">
                                    <?php
                                    $tjson = file_get_contents('appginilte/tables_config.json', true);
                                    $tjson = json_decode($tjson, true);
                                    foreach ($groups as $grp => $tables) {
                                        foreach ($tables as $tn) {
                                            $json = json_encode(get_tables_info(true));
                                            $decode = json_decode($json);
                                            $table_title = $decode->$tn->Caption;
                                            $jtt = str_replace(" ", "_", $table_title);
                                            $card_color = $tjson[$jtt . '_color'] ? $tjson[$jtt . '_color'] : 'primary';
                                            $card_icon = $tjson[$jtt . '_icon'] ? $tjson[$jtt . '_icon'] : 'default';
                                            $card_fa = $tjson[$jtt . '_fa'] ? $tjson[$jtt . '_fa'] : 'fa fa-trophy';
                                            $card_hidden_hp = $tjson[$jtt . '_hidden_hp'] ? $tjson[$jtt . '_hidden_hp'] : '';
                                            $card_hidden_nm = $tjson[$jtt . '_hidden_nm'] ? $tjson[$jtt . '_hidden_nm'] : '';
                                            echo '
                                        <label class="text-primary">' . $table_title . ' <span class="fa fa-table"></span></label>
                                        <div class="row">
                                        <div class="col-lg-1 col-sm-12">
                                        <label><i>Card Color</i></label>
                                        <select id="card_color" name="' . $table_title . '_color" class="form-control"">
                                        <option value="primary" ' . ($card_color == "primary" ? 'selected' : '') . '>Primary</option>
                                        <option value="success" ' . ($card_color == "success" ? 'selected' : '') . '>Success</option>
                                        <option value="warning" ' . ($card_color == "warning" ? 'selected' : '') . '>Warning</option>
                                        <option value="danger" ' . ($card_color == "danger" ? 'selected' : '') . '>Danger</option>
                                        <option value="info" ' . ($card_color == "info" ? 'selected' : '') . '>Info</option>
                                        <option value="secondary" ' . ($card_color == "secondary" ? 'selected' : '') . '>Secondary</option>
                                      </select>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                        <label><i>Card Icon</i></label>
                                        <select id="' . $jtt . '_icon" name="' . $table_title . '_icon" class="form-control">
                                        <option value="default" ' . ($card_icon == "default" ? 'selected' : '') . '>Default Appgini Icon</option>
                                        <option value="fa" ' . ($card_icon == "fa" ? 'selected' : '') . '>Font Awesome Icon</option>
                                        </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                        <label><i>Hide In Home Page</i></label>
                                            <input type="text" class="form-control" value="' . $card_hidden_hp . '" name="' . $table_title . '_hidden_hp" placeholder="Enter Group names separated by a comma ,">
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                        <label><i>Hide In Nav Menu</i></label>
                                            <input type="text" class="form-control" value="' . $card_hidden_nm . '" name="' . $table_title . '_hidden_nm" placeholder="Enter Group names separated by a comma ,">
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                        <label id="' . $jtt . '_fa"><i>Font Awesome Icon</i></label>
                                            <input type="text" class="form-control" value="' . $card_fa . '" name="' . $table_title . '_fa" id="' . $jtt . '_fafa">
                                        </div>
                                        </div><hr>
                                        <script type="text/javascript">
                                        var ' . $jtt . '_icon = document.getElementById("' . $jtt . '_icon");
                                        var ' . $jtt . '_fa = document.getElementById("' . $jtt . '_fa");
                                        var ' . $jtt . '_fafa = document.getElementById("' . $jtt . '_fafa");
                                        var selectedIcon = ' . $jtt . '_icon.options[' . $jtt . '_icon.selectedIndex].value; 
                                        if(selectedIcon==="default"){' . $jtt . '_fa.style.display = "none";' . $jtt . '_fafa.style.display = "none";}
                                        if(selectedIcon==="fa"){' . $jtt . '_fa.style.display = "block";' . $jtt . '_fafa.style.display = "block";}
                                        $("#' . $jtt . '_icon").change(function(){
                                            var TheselectedIcon=$("#' . $jtt . '_icon").val();
                                            if(TheselectedIcon==="default"){' . $jtt . '_fa.style.display = "none";' . $jtt . '_fafa.style.display = "none";}
                                        if(TheselectedIcon==="fa"){' . $jtt . '_fa.style.display = "block";' . $jtt . '_fafa.style.display = "block";}
                                          });
                                        </script>
                                        ';
                                        }
                                    }
                                    ?>
                                    <br><button type="submit" class="btn btn-success" name="tbls">Save Changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
if (isset($_POST['tblgrps'])) {
    # code...
    $encode = json_encode($_POST);
    //write to appginilte/groups_config.json
    file_put_contents("appginilte/groups_config.json", $encode);
    echo '<script>alert("Table Group Changes Saved Successfully")</script>';
}
?>
<?php
if (isset($_POST['tbls'])) {
    # code...
    $jenc = json_encode($_POST);
    //write to appginilte/tables_config.json
    file_put_contents("appginilte/tables_config.json", $jenc);
    echo '<script>alert("Tables Changes Saved Successfully")</script>';
}
?>
<?php include 'appginilte_footer.php'; ?>