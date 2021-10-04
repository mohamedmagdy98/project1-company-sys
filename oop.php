<?php

class math
{
  private$even=array();
  private$odd=array();
  private$primary=array();

  public function iseven(array $xe){
    foreach ($xe as $i) {
      if ($i%2==0) {
        $even[]=$i;
      }
  }
  $oute1=implode(',',$even);
  $oute="even numbers".$oute1."<br>";
  return $oute;
 }
  public function isodd(array $xo){
      foreach ($xo as $i) {
        if ($i%2!=0) {
          $odd[]=$i;
        }
    }
    $outo1=implode(',',$odd);
    $outo="odd numbers".$outo1."<br>";
    return $outo;
  }
  public function primaryfounder($x){
        for ($j=2; $j <$x ; $j++) {
          if ($x%$j==0) {
            return 0;
          }
      }
      return 1;
    }
  public function isprimary(array $xp){
    foreach ($xp as $i) {

      $out1=$this->primaryfounder($i);
      if ($out1==1) {
        $primary[]=$i;
      }
  }
  $out2=implode(',',$primary);
  $out="primary numbers".$out2."<br>";
  return $out;
  }

}

$founder= new math();
$arr=array(1,2,3,4,5,6,7,8,9,10);
echo $founder->isodd($arr);
echo $founder->iseven($arr);
echo $founder->isprimary($arr);


 ?>
