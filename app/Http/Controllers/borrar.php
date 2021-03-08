

<?php

$imagefile = 'baterias.jpg';

/**
 * Opens new image
 *
 * @param $filename
 */


/**
 * Resize image maintaining aspect ratio, occuping
 * as much as possible with width and height inside
 * params.
 *
 * @param $image
 * @param $width
 * @param $height
 */
function resizeMax($image, $width, $height)
{
  /* Original dimensions */
  $origw = imagesx($image);
  $origh = imagesy($image);

  $ratiow = $width / $origw;
  $ratioh = $height / $origh;
  $ratio = min($ratioh, $ratiow);

  $neww = $origw * $ratio;
  $newh = $origh * $ratio;

  $new = imageCreateTrueColor($neww, $newh);

  imagecopyresampled($new, $image, 0, 0, 0, 0, $neww, $newh, $origw, $origh);
  return $new;
}

$imgh = icreate($imagefile);
$imgr = resizeMax($imgh, 400, 200);

header('Content-type: image/jpeg');
imagejpeg($imgr);