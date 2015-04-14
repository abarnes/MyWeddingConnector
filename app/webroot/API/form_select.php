<?php
include('config.php');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $leadcarrier_url."/get_selections");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close($ch);

$categories = json_decode($result);
//die(print_r($categories));
/*---------------------------Edit below this line to change the appearance of the industry select form----------------------------------*/
/*
echo '<form action="'.$site_url.'/API/parse.php" method="post">';
echo '<input type="hidden" name="id" value="0" id="id-replace">';
foreach ($categories as $c) {
  if ($c->Category->use_ranges=='0') {
    echo '<label class="'.$select_label_class.'">'.$c->Category->name.'</label>';
    echo '<input type="checkbox" name="c'.$c->Category->id.'" checked="true">';
  } else {
      echo '<label class="'.$select_label_class.'">'.$c->Category->name.'</label>';
      echo '<input type="checkbox" name="c'.$c->Category->id.'" label="'.$c->Category->name.'" checked="true"><br/>';
      echo '<select name="'.$c->Category->id.'">';
      foreach ($c->Range as $r) {
        echo '<option value="'.$r->id.'">'.$r->name.'</option>';
      }
      echo '</select>';
  }
  echo '<br/><br/>';
}
echo '<input type="submit" value="submit" class="'.$submit_button_class.'"/></form>';*/

echo '<form action="'.$site_url.'/API/parse.php" method="post">';
echo '<input type="hidden" name="id" value="0" id="id-replace">';
echo '<div><table><tr>';
                        $cc = 0;
                        foreach ($categories as $c) {
                            if ($cc%2==0) {
                                echo '</tr><tr><td>';
                            } else {
                                echo '<td>';
                            }
                            
                            if ($c->Category->use_ranges=='0') {
                                echo '<input type="checkbox" name="c'.$c->Category->id.'" checked="true" class="checkal"><label class="'.$select_label_class.'">'.$c->Category->name.'</label><br/><br/>';
                            } else {
                                echo '<input type="checkbox" name="c'.$c->Category->id.'" checked="true" class="checkal"><label class="'.$select_label_class.'">'.$c->Category->name.'</label><br/>';
                                echo '<select name="v'.$c->Category->id.'">';
                                foreach ($c->Range as $r) {
                                  echo '<option value="'.$r->id.'">'.$r->name.'</option>';
                                }
                                echo '</select>';
                            }
                            echo '</td>';
                            $cc++;
                        }
echo '</tr></table></div>';
echo '<input class="sel-submit" src="/img/sel-submit.png" type="image"/>';
/*--------------*/
exit();
?>  