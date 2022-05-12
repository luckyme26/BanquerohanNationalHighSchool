<!DOCTYPE html>
<html>
<!--<title>Banquerohan National High School</title>-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?= base_url(); ?>resource/4w3.css">
<link rel="stylesheet" href="<?= base_url(); ?>resource/3w3.css">
<link rel="stylesheet" href="<?= base_url(); ?>resource/font-awesome-4.7.0/css/font-awesome.min.css">
<script src="<?= base_url(); ?>resource/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap">
<link rel="icon" href="<?php echo base_url()?>resource/img/logo.png">

<style>
	/*body{
		font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
	    font-size: 16px;
	    font-weight: normal;
	}
	html{
		scroll-behavior: smooth;
	}
	a{
		font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
	    font-size: 16px;
	    font-weight: normal;
	}
	p{
		font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		font-weight: normal;
        font-size: 16px;
	}*/

	/* FOR EXTRA SMALL */
	/*@media only screen and (min-width: 600px){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 12px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 12px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 12px;
		}
	}*/


	/* FOR SMALL */
	/*@media only screen and (max-width: 600px){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 16px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 16px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 16px;
		}
	}*/


	/* FOR MEDIUM */
	/*@media only screen and (min-width: 768px){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 16px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 16px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 16px;
		}
	}*/

	/* FOR LARGE */
	/*@media only screen and (min-width: 992px){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 16px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 16px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 16px;
		}
	}*/

	@media screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 1){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 15px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 15px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 15px;
		}
	}


	@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 1){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 16px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 16px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 16px;
		}
	}


	@media screen and (min-device-width: 1200px) and (max-device-width: 1600px) and (-webkit-min-device-pixel-ratio: 1){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 16px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 16px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 16px;
		}
	}


	@media screen and (min-device-width: 1200px) and (max-device-width: 1600px) and (-webkit-min-device-pixel-ratio: 1) and (min-resolution: 192dpi){
		body{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma', sans-serif;
		    font-size: 16px;
		    font-weight: normal;
		}
		html{
			scroll-behavior: smooth;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-weight: normal;
		}
		a{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
		    font-size: 16px;
		    font-weight: normal;
		}
		p{
			font-family: 'Poppins', 'Helvetica', 'Arial', 'Tahoma';
			font-weight: normal;
	        font-size: 16px;
		}
	}
	
</style>