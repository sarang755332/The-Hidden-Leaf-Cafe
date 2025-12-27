 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <style>
    
        div.scroll-container {
          background-color: #333;
          overflow: auto;
          
          padding: 10px;
        }

    
            .scroll-container {
              background-color: #333;
              overflow-x: auto;
              overflow-y: hidden;
              white-space: nowrap;
              padding: 10px 0;
              margin-top: 0;
              height: calc(100vh - 48px); 
              }

                .scroll-container img {
                height: 90%;
                width: auto;
                display: inline-block;
                padding: 10px;
                vertical-align: middle;
            }

    </style>

    <title>Menu</title>
    
    
    <title>Menu</title>

     <link rel="stylesheet" href="css/style2.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
     
</head>
 <body>
    <!-- added navbar -->

      <?php include 'includes/navbar.php'; ?>

      <!-- added menu -->
     <div class="scroll-container">
      <img src="menu/mfront.png" alt="mfront">
     <img src="menu/m1.png" alt="m1">
     <img src="menu/m2.png" alt="m2">
     <img src="menu/m3.png" alt="m3">
     <img src="menu/m4.png" alt="m4">
     </div>
     <?php include 'includes/footer.php'; ?>
 </body>
 </html>