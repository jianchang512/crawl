<?php
$url = "http://www.sina.com.cn";
$str = file_get_contents($url);
//echo $str;
//$str = file_get_contents('3.html');



/**
 *  从一个字符串提取所有的 meta 标签 content 属性，返回一个数组
 *  get_meta_tags
 */
function getMetaTags($str)
{
    $result = array();
    $matePattern = '/<meta\s+(content|name\s?=.*)\s?\/?>/iUs';
    preg_match_all($matePattern, $str, $mateMatch);
//    print_r($mateMatch);exit;
    if(count($mateMatch) > 0){
         foreach($mateMatch[1] as $v){
             $v = $v." ";
             $matePatternReplace = '/(name|content)\s?=\s?(["\S"]+|[\S]+)\s+/iUs';
             preg_match_all($matePatternReplace, $v, $mateMatchReplace);
//             print_r($mateMatchReplace);
             if(count($mateMatchReplace) > 0){
//                 print_r($mateMatchReplace);
                 if(!empty($mateMatchReplace[2][0])) {
                     if(empty($mateMatchReplace[2][1])) $mateMatchReplace[2][1] = '';
                     else
                     $mateMatchReplace[2][0]          = strtolower(trim($mateMatchReplace[2][0],'"'));

                     $result[$mateMatchReplace[2][0]] = trim($mateMatchReplace[2][1],'"');
                 }
                }
              }
         }
    return $result;
}


print_r(getMetaTags($str));
//$metas = get_meta_tags($url);
//print_r($metas);


