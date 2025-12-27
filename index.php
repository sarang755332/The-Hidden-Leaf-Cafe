<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  

  

  <!-- added style to navbar -->

  <style>
   
    /* Styling for the Hero Section (Home Section) */
    .hero-section {
      position: relative;
      width: 100%;
      height: 650px;
      background: url('images/cafe-interior.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: #FFF;
      overflow: hidden;
    }

    .hero-content {
      z-index: 2;
      padding: 20px;
       
      border-radius: 10px;
      max-width: 800px;
    }

    .hero-logo {
      width: 150px;
      height: auto;
      margin-bottom: 20px;
      border-radius: 50%;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .hero-section h1 {
      font-size: 3.5rem;
      margin-bottom: 10px;
      color: #FFD700;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
      font-family: 'Georgia', serif;
    }

    .hero-section p {
      font-size: 1.2rem;
      color: #064d21;
      margin-bottom: 5px;
      text-shadow: 1px 1px 2px rgba(231, 221, 221, 0.5);
    }

    main section:not(#home) {
      padding: 60px 20px;
      min-height: 400px;
      display: flex;
      justify-content: center;
      align-items: center;
      box-sizing: border-box;
    }

    main section:nth-of-type(even) {
      background-color: #f8f8f8;
    }

    @media (max-width: 768px) {
      .hero-section {
        height: 500px;
      }

      

      .hero-section h1 {
        font-size: 2.5rem;
        /* Smaller heading for mobile */
      }

      .hero-section p {
        font-size: 1rem;
      }

      .hero-content {
        padding: 15px;
      }
    }

    @media (max-width: 480px) {
      .hero-section {
        height: 400px;
      }

      

      .hero-section h1 {
        font-size: 2rem;
      }
    }

   

    .jj {
      background-image: url('images/img21.jpg');
      background-size: 100% auto;
      background-repeat: no-repeat;
    }
.hero-content h1,
.hero-content p {
    font-family: 'Playfair Display', serif;
}
    
  </style>

  <title>Home</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="css/style2.css">
</head>

<body>

 <!-- added navbar -->
<?php include 'includes/navbar.php'; ?> 


 <!-- added logo and bg image -->
  
    <main class="jj">
      <section id="home" class="hero-section">
        <div class="hero-content" >
          <img src="images/img13.png" alt="The Hidden Leaf Cafe Logo" class="hero-logo">
          <h1 style="font: Playfair Display, serif;">The Hidden Leaf Cafe</h1>
          <b>
            <p>WELCOME TO OUR CAFE</p>
            <p>We are grateful to have you on our cafe's website.</p>
          </b>
        </div>
      </section>
      <section class="features-amenities-section">
        <div class="container">
               <h2 class="section-heading">Our Cafe's Unique Offerings & Atmosphere</h2>
                <p class="section-subheading">Discover what makes The Hidden Leaf Cafe your perfect spot.</p>

                <div class="features-grid">

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-hand-holding-heart icon-heading"></i> Service Options</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-box-open feature-icon"></i> Takeaway</li>
                            <li><i class="fas fa-utensils feature-icon"></i> Dine-In</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-star icon-heading"></i> Highlights</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-mug-hot feature-icon"></i> Great Coffee</li>
                            <li><i class="fas fa-ice-cream feature-icon"></i> Great Dessert</li>
                            <li><i class="fas fa-leaf feature-icon"></i> Great Tea Selection</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-tags icon-heading"></i> Popular For</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-user feature-icon"></i> Solo Dining</li>
                            <li><i class="fas fa-user feature-icon"></i>Event Organization </li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-pizza-slice icon-heading"></i> Offerings</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-cocktail feature-icon"></i> Cocktails</li>
                            <li><i class="fas fa-coffee feature-icon"></i> Coffee</li>
                            <li><i class="fas fa-seedling feature-icon"></i> Organic Dishes</li>
                            <li><i class="fas fa-bolt feature-icon"></i> Quick Bite</li>
                            <li><i class="fas fa-plate-wheat feature-icon"></i> Small Plates</li>
                            <li><i class="fas fa-carrot feature-icon"></i> Vegan Options</li>
                            <li><i class="fas fa-leaf-heart feature-icon"></i> Vegetarian Options (incl. Veg-only)</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-clock icon-heading"></i> Dining Options</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-cloud-sun feature-icon"></i> Brunch</li>
                            <li><i class="fas fa-sun feature-icon"></i> Breakfast</li>
                            <li><i class="fas fa-cloud feature-icon"></i> Lunch</li>
                            <li><i class="fas fa-moon feature-icon"></i> Dinner</li>
                            <li><i class="fas fa-ice-cream feature-icon"></i> Dessert</li>
                            <li><i class="fas fa-chair feature-icon"></i> Seating</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-th-list icon-heading"></i> Amenities</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-wifi feature-icon"></i> Free WI-FI</li>
                            <li><i class="fas fa-restroom feature-icon"></i> Restroom</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-couch icon-heading"></i> Atmosphere</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-fireplace feature-icon"></i> Cozy</li>
                            <li><i class="fas fa-smile-beam feature-icon"></i> Casual</li>
                            <li><i class="fas fa-star feature-icon"></i> Trendy</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-users icon-heading"></i> Crowd</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-child feature-icon"></i> Family Friendly</li>
                            <li><i class="fas fa-user-friends feature-icon"></i> Groups</li>
                            <li><i class="fas fa-graduation-cap feature-icon"></i> University Students</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-calendar-alt icon-heading"></i> Planning</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-calendar-check feature-icon"></i> Accepts Reservations</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-wallet icon-heading"></i> Payments</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-credit-card feature-icon"></i> Credit Cards</li>
                            <li><i class="fas fa-mobile-alt feature-icon"></i> NFC Mobile Payments</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-baby feature-icon"></i> Children</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-child feature-icon"></i> Good for Kids</li>
                        </ul>
                    </div>

                    <div class="feature-category">
                        <h3 class="category-heading"><i class="fas fa-parking icon-heading"></i> Parking</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-warehouse feature-icon"></i> Free Parking Garage</li>
                            <li><i class="fas fa-road feature-icon"></i> Free Street Parking</li>
                            <li><i class="fas fa-car feature-icon"></i> Free Parking Lot</li>
                        </ul>
                    </div>

                </div>
                </div>
                  </section>
    </main>
  

  

  

  

  <?php include 'includes/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>


</body>

</html>