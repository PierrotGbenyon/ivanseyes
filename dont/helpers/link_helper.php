<?php defined('BASEPATH') OR exit('No direct script access allowed');

  if (!function_exists('css'))
  {
  	function css($nom)
  	{
  		$css = 'upload/css/' . $nom . '.css';
  		return base_url($css);
  	}
  }

  /*			js	 */
  if ( ! function_exists('js'))
  {
  	function js($nom)
  	{
  		$js = 'upload/js/' . $nom . '.js';
  		return base_url($js);
  	}
  }

  /*			img	 */
  if ( ! function_exists('img'))
  {
  	function img($nom)
  	{
  		$img = 'upload/img/' . $nom;
  		return base_url($img);
  	}
  }

  /*			font_url	 */
  if ( ! function_exists('font'))
  {
  	function font($nom)
  	{
  		$font = 'upload/fonts/'.$nom;
  		return base_url($font);
  	}
  }
