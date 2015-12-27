<?php $imgSrc = "fbcdn-profile-a.akamaihd.net/hprofile-ak-snc7/372252_100000296786229_131061629_n.jpg";

//getting the image dimensions
list($width, $height) = getimagesize($imgSrc);

//saving the image into memory (for manipulation with GD Library)
$myImage = imagecreatefromjpeg($imgSrc);

// calculating the part of the image to use for thumbnail
if ($width > $height) {
  $y = 0;
  $x = ($width - $height) / 2;
  $smallestSide = $height;
} else {
  $x = 0;
  $y = ($height - $width) / 2;
  $smallestSide = $width;
}

// copying the part into thumbnail
$thumbSize = 200;
$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

//final output
header('Content-type: image/jpeg');
imagejpeg($thumb);

?>