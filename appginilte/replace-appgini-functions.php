<?php // Save this file as 'hooks/replace-appgini-functions.php'

$hooks_dir = dirname(__FILE__);
include("{$hooks_dir}/../defaultLang.php");
include("{$hooks_dir}/../language.php");
include("{$hooks_dir}/../lib.php");

// Step 1: Specify the file containing the function we want to overwrite
$appgini_file = "{$hooks_dir}/../incCommon.php";

// Step 2: Specify the file containing our version of the function
$mod_file = "{$hooks_dir}/mod.htmlUserBar.php";

// Step 3: Specify the name of the function we want to overwrite
$func_name = 'htmlUserBar';

echo "{$func_name}: " . replace_function($appgini_file, $func_name, $mod_file).'<br>' .replaceIndex();

#######################################

function replace_function($appgini_file, $function_name, $mod_file)
{
	// read the new code from the mod file
	$new_code = @file($mod_file);
	if (empty($new_code)) return 'No custom code found.';

	// remove the first line containing PHP opening tag and keep the rest as $new_snippet
	array_shift($new_code);
	$new_snippet = implode('', $new_code);

	$pattern1 = '/\s*function\s+' . $function_name . '\s*\(.*\).*(\R.*){200}/';
	$pattern2 = '/\t#+(.*\R)*/';

	$entire_code = file_get_contents($appgini_file);
	if (!$entire_code) return 'Invalid AppGini file.';

	$m = [];
	if (!preg_match_all($pattern1, $entire_code, $m)) return 'Function to replace not found.';
	$snippet = $m[0][0] . "\n";

	if (!preg_match_all($pattern2, $snippet, $m)) return 'Could not find the end of the function.';
	$snippet = str_replace($m[0][0], '', $snippet);

	$snippet_nocrlf = str_replace("\r\n", "\n", $snippet);
	$new_snippet_nocrlf = str_replace("\r\n", "\n", $new_snippet);
	if (trim($snippet_nocrlf) == trim($new_snippet_nocrlf)) return 'Function already replaced.';

	// back up the file before overwriting
	if (!@copy(
		$appgini_file,
		preg_replace('/\.php$/', '.backup.' . date('Y.m.d.H.i.s') . '.php', $appgini_file)
	)) return 'Could not make a backup copy of file.';

	$new_code = str_replace(trim($snippet), trim($new_snippet), $entire_code);
	if (!@file_put_contents($appgini_file, $new_code)) return "Couldn't overwrite file.";

	return 'Function overwritten successfully.';
}

function replaceIndex()
{
	global $hooks_dir;
	$index_file = "{$hooks_dir}/../index.php";
	//read the entire file
	$getfile = file_get_contents($index_file);

	//replace home.php in the file with appginilte_dashboard.php
	$putfile = str_replace('home.php', 'appginilte_dashboard.php', $getfile);

	//write the entire file
	if(!@file_put_contents($index_file, $putfile)) return "Couldn't overwrite Index file.";

	return 'Index file overwritten successfully.';
}
