<?php
require_once('pdo-connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="recipe-overview-styles.css">
  <title>Recipe overview</title>
</head>

<body>
  <h1 class="title-page"> Recipes</h1>
  <div class="container">
    <div class="search-bar">
      <input type="text" placeholder="Search..." class="input-search-bar">
    </div>
  </div>
  <div class="main-page">
    <div class="filters">
      <h1 class="left-page-title">Filter by</h1>

      <label for="filter1" class="title-filter"> Diet</label><br>
      <input type="checkbox" id="filter1" name="filter1" value="vegetarian">
      <label for="filter1"> Vegetarian</label><br>
      <input type="checkbox" id="filter2" name="filter2" value="vegan">
      <label for="filter2"> Vegan</label><br><br>

      <label for="filter3" class="title-filter"> Time</label><br>
      <input type="checkbox" id="filter3" name="filter3" value="less15">
      <label for="filter3"> &lt 15 min</label><br>
      <input type="checkbox" id="filter4" name="filter4" value="15to30">
      <label for="filter4"> 15-30 min</label><br>
      <input type="checkbox" id="filter5" name="filter5" value="30to60">
      <label for="filter5"> 30-60 min</label><br>
      <input type="checkbox" id="filter6" name="filter6" value="60more">
      <label for="filter6"> 60+ min</label><br><br>

      <label for="filter7" class="title-filter"> Servings</label><br>
      <input type="checkbox" id="filter7" name="filter7" value="1serving">
      <label for="filter7"> 1 serving</label><br>
      <input type="checkbox" id="filter8" name="filter8" value="2servings">
      <label for="filter8"> 2 servings</label><br>
      <input type="checkbox" id="filter9" name="filter9" value="3servings">
      <label for="filter9"> 3 servings</label><br>
      <input type="checkbox" id="filter10" name="filter10" value="4moreservings">
      <label for="filter10"> 4+ servings</label><br><br>

      <label for="filter11" class="title-filter"> Rating</label><br>
      <input type="checkbox" id="filter11" name="filter11" value="1star">
      <label for="filter11"> 1 star</label><br>
      <input type="checkbox" id="filter12" name="filter12" value="2stars">
      <label for="filter12"> 2 stars</label><br>
      <input type="checkbox" id="filter13" name="filter13" value="3stars">
      <label for="filter13"> 3 stars</label><br>
      <input type="checkbox" id="filter14" name="filter14" value="4stars">
      <label for="filter14"> 4 stars</label><br>
      <input type="checkbox" id="filter15" name="filter15" value="5stars">
      <label for="filter15"> 5 stars</label><br>
    </div>
    <div class="recipes">
    </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src = "filter_handeling.js"></script>
</body>
</html>

