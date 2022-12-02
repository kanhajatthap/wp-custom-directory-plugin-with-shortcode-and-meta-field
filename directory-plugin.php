<?php
/**
* Plugin Name: Custom Directory Plugin
* Plugin URI: https://iq-mag.net/
* Description: This plugin is provide directorys.
* Version: 0.1
* Author: Ben Delger
* Author URI: https://www.iq-mag.net/
**/


// Custom Post Type: Directory
include('custom-post-types.php');
add_action( 'init', 'directory_init' );

// Custom Fields
include('custom-fields.php');
add_action( 'init', 'directory_init' );

// Custom Fields
// include('repeater/repeater.php');
// add_action( 'init', 'directory_init' );

// // Custom Fields
// include('acf-repeater/acf-repeater-update.php');
// add_action( 'init', 'directory_init' );




// Style
?>
<style>
/* .directory_iteams .loop_div.iteam .country1 h5 {
    width: 100%;
    font-size: 15px;
}
div#loader {
    margin: 0px auto;
    text-align: center;
    background: #fff;
    padding: 30px;
}
div#loader img{
    width: 50px;
}
.directory_iteams .loop_div.iteam .title h5 {
    width: 100%;
    color: #ff7d4f;
    font-size: 15px;
}

.directory_iteams .loop_div.iteam {
    display: flex;
    flex-wrap: wrap;
    border: solid 1px #ddd;
    margin: 10px;
}

.directory_iteams .loop_div.iteam .country1 {
    order: 3;
}

.directory_iteams .loop_div.iteam .country2 {
    order: 1;
}

.directory_iteams .loop_div.iteam .title {
    order: 2;
    width: 100%;
    height: 30px;
}

.directory_iteams .loop_div.iteam .directoryContent {
    order: 4;
    width: 100%;
}

.directoryheader select {
    width: 20%;
    margin: 0 10px 0 0;
    padding: 14px;
    float: left;
}

.directoryheader input {
    width: 30%;
    padding: 14px 15px;
    margin: 0 10px 0 0;
    float: left;
    color: #000;
}

.directoryheader {
    background: #fff;
    padding: 55px 4px 0 45px;
    display: table;
    width: 100%;
}

.directoryheader input[type=button] {
    color: #ff7d4f !important;
    border: 2px solid #ff7d4f !important;
    height: 42px;
    float: left;
    width: 100px;
}

.pagination-page {
    text-align: center;
    padding-bottom: 50px;
    background: #fff;
    font-weight: 400;
}

.pagination-page ul {
    margin: 0;
    padding: 0;
}

.pagination-page ul li {
    display: inline-block;
    padding: 12px;
    font-size: 18px;
}

.directoryheader input[type=button]:hover {
    color: #fff !important;
}

.directory_iteams .content {
    padding: 0;
}

.directoryAdminContainer {
    background: #ddd;
    padding: 30px;
}

.directoryBox {
    max-width: 500px;
}

.directoryBox label {
    width: 100%;
    display: block;
    padding-bottom: 6px;
    margin-top: 18px;
    font-size: 14px;
    font-weight: 600;
}

body .directoryBox input {
    width: 100%;
    padding: 5px 12px;

}

.directoryTitle {
    font-size: 18px;
    font-weight: 600;
    color: #ee7830;
    border-top: solid 2px #000;
    padding-top: 20px;
}

.directoryContent,
.directoryContent p,
.directoryContent a {
    color: #000;
    font-size: 15px;
    font-weight: 400;
    font-family: Raleway, sans-serif !important;
    line-height: 1.6em;
}

.directory_iteams {
    background: #fff;
    display: flex;
    flex-wrap: wrap;
    padding: 15px 35px 35px 35px;
}

.directory_iteams .iteam {
    flex: 1 1 47%;
    padding: 25px;
}

.directory_iteams h5 {
    font-size: 18px;
    padding-top: 2px;
}

.directory_iteams p {
    padding: 0;
    margin: 0;
    line-height: 1.4em;
}

.directoryContent a {
    color: #ff7d4f;
}

.directoryheader .search-form {}

.directoryheader input.search {
    font-size: 16px;
    background: #fff;
    border: solid 1px #767676 !important;
    color: #000;
    border-radius: 3px !important;
    font-weight: 500;
}

.directoryheader .suggestions {
    margin: 0;
    padding: 0;
    position: relative;
}

.directoryheader .suggestions li {
    background: white;
    border-bottom: 1px solid #D8D8D8;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.14);
    display: flex;
    justify-content: space-between;
    list-style: none;
    margin: 0;
    padding: 20px 0;
    text-transform: capitalize;
    transition: background 0.2s;
}

.directoryheader span.population {
    font-size: 15px;
}

.directoryheader .hl {
    background: #ee3399;
}

.directoryheader a {
    background: rgba(0, 0, 0, 0.1);
    color: black;
    text-decoration: none;
}

form.short-form {
    padding: 0 30px 20px 0;
}

form.short-form select {
    width: 100%;
    padding: 10px;
}

.short-forms {
    display: flex;
}

.directoryheader h1 {
    padding-bottom: 30px;
}
.directory_iteams .loop_div.iteam .country2 h5 {
    font-size: 24px;
}
/* Loader CSS */
/* .loader {
  border: 16px solid #ff7d4f;
  border-radius: 50%;
  border-top: 16px solid #efc0af;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
} */

/* 
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
} */
</style>
<?php