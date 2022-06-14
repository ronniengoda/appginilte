<?php
include 'groups_config_lte.php';
include 'tables_config_lte.php';

$groups = get_table_groups();
foreach ($groups as $grp => $tables) {
  # code...
  $tlink = '';
  if ($grp !== "None") {
    // code...
    $gn = str_replace(" ", "_", $grp);
    $grpicon = $cjson[$gn . '_fa'] ? $cjson[$gn . '_fa'] : 'fa fa-table';
    $grptop = '<li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon ' . $grpicon . '"></i>
      <p>
        ' . $grp . '
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">';
    foreach ($tables as $tn) {
      $json = json_encode(get_tables_info(true));
      $decode = json_decode($json);
      $table_title = $decode->$tn->Caption;
      $tableIcon = $decode->$tn->tableIcon;
      $jtt = str_replace(" ", "_", $table_title);
      $menu_hidden = $djson[$jtt . '_hidden_nm'] ? $djson[$jtt . '_hidden_nm'] : '';
      $menu_icon = $djson[$jtt . '_icon'] ? $djson[$jtt . '_icon'] : 'default';
      $menu_fa = $djson[$jtt . '_fa'] ? $djson[$jtt . '_fa'] : 'fa fa-trophy';
      $show_icon = ($menu_icon == 'default') ? '<img src="' . $tableIcon . '">' : '<i class="' . $menu_fa . ' nav-icon"></i>';
      /* hide current menu in nav menu? */
      if (strpos($menu_hidden, $group) === false) {
        $tlink .= '<li class="nav-item">
      <a href="appginilte_view.php?page=' . $tn . '_view.php?Embedded=true" class="nav-link">
       '.$show_icon.'
        <p>' . $table_title . '</p>
      </a>
    </li>';
      }
    }
    $grpbtm = '</ul></li>';
    echo empty($tlink)? '': $grptop . $tlink . $grpbtm;
  } else {
    foreach ($tables as $tn) {
      $json = json_encode(get_tables_info(true));
      $decode = json_decode($json);
      $table_title = $decode->$tn->Caption;
      $tableIcon = $decode->$tn->tableIcon;
      $jtt = str_replace(" ", "_", $table_title);
      $menu_hidden = $djson[$jtt . '_hidden_nm'] ? $djson[$jtt . '_hidden_nm'] : '';
      $menu_icon = $djson[$jtt . '_icon'] ? $djson[$jtt . '_icon'] : 'default';
      $menu_fa = $djson[$jtt . '_fa'] ? $djson[$jtt . '_fa'] : 'fa fa-trophy';
      $show_icon = ($menu_icon == 'default') ? '<img src="' . $tableIcon . '">' : '<i class="' . $menu_fa . ' nav-icon"></i>';
      /* hide current menu in nav menu? */
      if (strpos($menu_hidden, $group) === false) {
        $tlink .= ' <li class="nav-item">
      <a href="appginilte_view.php?page=' . $tn . '_view.php?Embedded=true" class="nav-link">
      '.$show_icon.'
        <p>
        ' . $table_title . '
        </p>
      </a>
    </li>';
      }
    }
    echo $tlink;
  }
}
//custom nav links, as defined in "hooks/links-navmenu.php" .
if (is_array($navLinks)) {
  $memberInfo = getMemberInfo();
  $links_added = [];
  foreach ($navLinks as $link) {
    if (!isset($link['url']) || !isset($link['title'])) continue;
    if (getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
      $menu_index = intval($link['table_group']);
      if (!$links_added[$menu_index]) $menu[$menu_index] .= '<li class="divider"></li>';

      /* add prepend_path to custom links if they aren't absolute links */
      if (!preg_match('/^(http|\/\/)/i', $link['url'])) $link['url'] = $prepend_path . $link['url'];
      if (!preg_match('/^(http|\/\/)/i', $link['icon']) && $link['icon']) $link['icon'] = $prepend_path . $link['icon'];

      $menu[$menu_index] .= "<li  class=\"nav-item\"><a href=\"{$link['url']}\" class=\"nav-link\"><img src=\"" . ($link['icon'] ? $link['icon'] : "{$prepend_path}blank.gif") . "\" height=\"32\"> <p>{$link['title']}</p></a></li>";
      $links_added[$menu_index]++;
    }
  }
  $menu_wrapper = '';
  for ($i = 0; $i < count($menu); $i++) {
    $menu_wrapper .= <<<EOT
				{$menu[$i]}
EOT;
  }

  echo  $menu_wrapper;
}
