<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="css/style2.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
     

</head>
<body>
    <?php include 'includes/navbar.php'; ?>
<main>
    <section class="reviews-page-hero">
        <div class="hero-overlay">
            <h1>What Our Customers Say</h1>
            <p>Hear from our wonderful guests and see our ratings from across the web!</p>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-heading">Customer Testimonials</h2>
            <p class="section-subheading">Authentic experiences shared by those who love our cafe.</p>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"A charming cafe xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxx xxxxxxxxxxx."</p>
                    <div class="author-info">
                        <span class="author-name">name1</span>
                        <span class="author-location"> - Location/type</span>
                    </div>
                    <i class="fas fa-quote-right quote-icon"></i>
                </div>

                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"This is xxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx xxxxxxxxx."</p>
                    <div class="author-info">
                        <span class="author-name">Name2.</span>
                        <span class="author-location"> - Location/type</span>
                    </div>
                    <i class="fas fa-quote-right quote-icon"></i>
                </div>

                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">They serve  xxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxx"</p>
                    <div class="author-info">
                        <span class="author-name">Name 3</span>
                        <span class="author-location"> - location/Type</span>
                    </div>
                    <i class="fas fa-quote-right quote-icon"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="external-reviews-section">
        <div class="container">
            <h2 class="section-heading">Find Us & Our Reviews On</h2>
            <p class="section-subheading">See what people are saying about us on other platforms and leave your own review!</p>

            <div class="external-platforms-grid">
                <div class="platform-card">
                    <div class="platform-header">
                        <i class="fab fa-google platform-icon google-icon"></i>
                        <h3>Google Reviews</h3>
                    </div>
                    <div class="platform-rating">
                        <span class="rating-number">4.6</span>
                        <div class="stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">(79+ reviews)</span>
                    </div>
                    <p class="platform-quote">"Best brunch in town! Always a pleasant experience with great service and atmosphere."</p>
                    <a href="https://www.google.com/maps/place/The+Hidden+Leaf+Cafe/@19.9821643,79.2773417,17z/data=!4m8!3m7!1s0x3bd2d7c3a97bc8db:0x3fd7b4ec6c0e2834!8m2!3d19.9821643!4d79.2773417!9m1!1b1!16s%2Fg%2F11vrrs4wgq?entry=ttu&g_ep=EgoyMDI1MDYwNC4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="platform-btn google-btn">Read Reviews / Leave a Review</a>
                </div>

                <div class="platform-card">
                    <div class="platform-header">
                        <i class="fas fa-link platform-icon justdial-icon"></i> <h3>Justdial Reviews</h3>
                    </div>
                    <div class="platform-rating">
                        <span class="rating-number">4.5</span>
                        <div class="stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">(79+ ratings)</span>
                    </div>
                    <p class="platform-quote">"Quick service and delicious quick bites. Perfect for a busy day when you need a great coffee fix."</p>
                    <a href="https://www.justdial.com/Chandrapur/The-Hidden-Leaf-Cafe-Beside-Vidya-NiketanAbove-Prime-Motors-Wadgaon/9999P7172-7172-240523020602-G8W8_BZDET" target="_blank" class="platform-btn justdial-btn">Read Reviews / View Profile</a>
                </div>

                </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>