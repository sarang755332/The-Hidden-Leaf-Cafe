<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Bootstrap Bundle with Popper  for carousel -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>


  <!-- added background color -->
  <style>
    body {
      background-color: rgb(10, 10, 10);
    }
  </style>

  <!-- added style to navebar -->

  <style>
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
      position: sticky;
      top: 0;
      width: 100%;

    }

    li {
      float: left;
    }

    li a {
      display: block;
      color: rgb(254, 253, 253);
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    li a:hover {
      background-color: #111;
    }
  </style>

  <!-- added text effects -->
  <style>
    h2 {
      color: rgb(255, 254, 254);
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
      font-family: 'Arial', sans-serif;
      font-weight: bold;
    }

    .figure:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease;

    }
  </style>

  <title>Gallery</title>
</head>

<body>
  <ul>
    <li><a href="cafe.html">Home</a></li>
    <li><a href="images2.html">Gallery</a></li>
    <li><a href="menu.html">Menu</a></li>
    <li><a href="about.html">About Us</a></li>

  </ul>

  <!-- Images Display-->
  <center>
    <div class="container mt-4">
      <h1 style="color: white; text-shadow: 3px 3px 5px rgb(57, 103, 51);">Gallery</h1>
      <br><br>
      <h2 style="color: white; text-shadow: 3px 3px 5px rgb(222, 66, 38);">Food</h2>
      <br>
      <div class="row">
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/food1.jfif" class="figure-img img-fluid rounded" alt="Image 1"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Makhani Sauce
              Pasta
            </figcaption>
          </figure>
          <br>
        </div>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/food2.jfif" class="figure-img img-fluid rounded" alt="Image 2"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Barbeque Pizza
              (BBQ)</figcaption>
          </figure>
          <br>
        </div>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/food3.jfif" class="figure-img img-fluid rounded" alt="Image 3"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Blue Lagoon
            </figcaption>
          </figure>
          <br>
        </div>
        <br>
        <h2 style="color: white; text-shadow: 3px 3px 5px rgb(222, 66, 38);">Cafe View</h2>
        <br><br>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/cf1.jfif" class="figure-img img-fluid rounded" alt="Image 4"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Cafe View
            </figcaption>
          </figure>
          <br>
        </div>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/cf2.jfif" class="figure-img img-fluid rounded" alt="Image 5"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Cafe View
            </figcaption>
          </figure>
          <br>
        </div>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/cf3.jpg" class="figure-img img-fluid rounded" alt="Image 6"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Cafe View
            </figcaption>
          </figure>
          <br>
        </div>
        <br>
        <h2 style="color: white; text-shadow: 3px 3px 5px rgb(222, 66, 38);">Events</h2>
        <br>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/event1.jfif" class="figure-img img-fluid rounded" alt="Image 7"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">DJ Night Event
            </figcaption>
          </figure>
          <br>
        </div>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/event2.jfif" class="figure-img img-fluid rounded" alt="Image 8"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">Standup Comedy
              Event </figcaption>
          </figure>
          <br>
        </div>
        <div class="col-md-4">
          <figure class="figure">
            <img src="images/event3.jfif" class="figure-img img-fluid rounded" alt="Image 9"
              style="box-shadow: 5px 5px 15px lightblue;">
            <figcaption class="figure-caption" style="color: white; text-shadow: 2px 2px 4px lightblue;">DJ Pranil At
              Cafe (DJ Event)
            </figcaption>
          </figure>
          <br>
        </div>

      </div>
    </div>
  </center>



  <center>

    <h2 style="color: rgb(255, 254, 254); text-shadow: 3px 3px 5px rgb(72, 100, 117);">Visit Our Instagram Profile for
      More Photos and Videos.<br> Follow for Latest Updates.&#128516;</h2>

  </center>

  <br><br>


</body>

</html>