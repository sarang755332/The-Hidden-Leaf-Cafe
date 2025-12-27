<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap Bundle with Popper  for carousel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- added background -->

    <style>
        body {
             margin: 0;
      padding: 0;
      height: 100vh;
      background: url('images/gemini2.png') no-repeat center center fixed;
      background-size: cover;
      /* Simulated transparency */
      position: relative;
     }
     .content {
     font-family: Garamond, serif;
      }
      h2{
       font-family: Copperplate, Papyrus, fantasy;
          }
              .container {
           display: flex;
         align-items: center; 
           justify-content: space-between;
        }

        .content {
            flex: 1;
  
         }

      .image {
     flex: 1;
       display: flex;
      justify-content: flex-end;
     }

       .image img {
         max-width: 100%;
       height: auto;
       }

            body {
             font-family: 'Montserrat', Arial, sans-serif;
              }
          image{
           border-radius: 10%;
             }
 

    
        
    </style>

   

    <title>About us</title>
    
    <link rel="stylesheet" href="css/style2.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    
</head>

 <body>

      <!-- added navbar -->

     <?php include 'includes/navbar.php'; ?>
     

       <br><br>
     <div class="container">
        <div class="content">

        <h2>About us</h2>
     <p class="p"> Welcome to The Hidden Leaf Cafe, Chandrapur's beloved haven for delicious food and good vibes! Established in 2023, we've quickly become known as one of the best cafes in the city, and for good reason. Nestled in a prime location, The Hidden Leaf Cafe offers a warm and inviting atmosphere that's perfect for everyone.

Whether you're looking for a tasty meal to fuel your day, a cozy spot to catch up with friends, or a welcoming environment for your family or a romantic outing, you'll find it here. We pride ourselves on serving up delicious food made with quality ingredients, ensuring every bite is a delight.

Our Story: Finding Comfort in Connection

The idea for The Hidden Leaf Cafe blossomed from a simple desire: to create a space where people could find a sense of comfort and connection, much like finding a hidden gem in a familiar landscape. In today's fast-paced world, we noticed a growing need for a place where individuals, families, and couples could step away from the everyday hustle and simply enjoy good company and great food.

We envisioned a cafe that felt like a natural extension of home – a place where laughter flows easily, conversations linger, and everyone feels welcome. Just as a hidden leaf offers shade and respite, we wanted our cafe to be a comforting retreat for the Chandrapur community.

Inspired by the warmth of shared meals and the joy of simple pleasures, we poured our hearts into creating The Hidden Leaf Cafe. From carefully selecting our menu to designing a space that exudes positive energy, every detail has been thoughtfully considered to provide you with an exceptional experience.

We are more than just a cafe; we are a community hub, a place where memories are made, and where the simple act of sharing a meal becomes something special. Come and discover the warmth of The Hidden Leaf Cafe – we can't wait to welcome you!</p>
</div>
<div class="image">
    <img src="images/img13.png" alt="Cafe logo" style="border-radius: 50%;" />
  </div>   
</div>
<?php include 'includes/footer.php'; ?>
 </body>

</html>