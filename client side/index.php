<!doctype html>
<html lang="en">
  <<?php
include("../conn.php");
$sql="SELECT * FROM `hero-section`";
$result = $conn->query($sql);
$heros=$result->fetch_all(MYSQLI_ASSOC);
?>

<?php
$sql="SELECT * FROM `about`";
$result = $conn->query($sql);
$about=$result->fetch_all(MYSQLI_ASSOC);
?>

<?php
$sql="SELECT * FROM `categories`";
$result = $conn->query($sql);
$categories=$result->fetch_all(MYSQLI_ASSOC);
?>

<?php
$sql1="SELECT * FROM `pizzas` INNER join categories on pizzas.category_id=categories.category_id";
$result1=$conn->query($sql1);
$pizzas=$result1->fetch_all(MYSQLI_ASSOC);
?>
  <head>
    <title>Pizza House</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fuzzy+Bubbles:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <img
          src="Images/pizza-slice-vector-icon.jpg"
          alt="pizza slice"
          style="width: 70px"
          class="img-fluid"
        />
        <p><span class="p1">Pizza</span> <span class="p2">Bite</span></p>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-center"
          id="navbarNavDropdown"
        >
          <ul class="navbar-nav">
            <li class="nav-item me-5">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="#menu">Menu</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid hero-header mb-5" id="home">
      <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
          <div class="col-lg-6 text-center text-lg-start">
            <?php foreach ($heros as $hero){ ?>
            <p>
              F R E S H&nbsp;&nbsp;&#183;&nbsp;&nbsp;H O
              T&nbsp;&nbsp;&#183;&nbsp;&nbsp;D E L I C I O U S
            </p>
            <h1 class="display-3 animated slideInLeft">
              <?php echo $hero['hero_title'] ?>
            </h1>
            <p class="animated slideInLeft mb-4 pb-2">
              <?php echo $hero['hero_description'] ?>
            </p>
            <a href="#menu">
              <button class="py-sm-3 px-sm-5 me-3 btn1">View Menu</button></a
            >
          </div>
          <div class="col-lg-6 text-center text-lg-end overflow-hidden">
            <img
              class="img-fluid"
              src="../Admin page/uploads/pizza bite/<?php echo htmlspecialchars($hero['hero_image']) ?>"
              style="width: 3000px"
              alt=""
              class="img-fluid"
            />
          </div>
          <?php } ?>            
        </div>
      </div>
    </div>

    <div class="container-fluid bg-light mb-4 p-4" id="about">
      <div class="container">
        <div class="container mb-4">
          <h4 class="h2">Why Choose Us ?</h4>
        </div>
        <div class="row">
           <?php foreach ($about as $a){ ?>
          <div class="col-md-3 mb-3">
            <div class="card card1">
              <div class="card-body d-flex">
                <div>
                  <img
                    src="Images/red-pizza-slice-illustration-with-cheese-and-pepperoni-in-a-simplified-outline-design-vector.jpg"
                    alt="delivery icon"
                    style="width: 65px"
                    class="img-fluid"
                  />
                </div>
               
                <div>
                  
                  <h4 class="card-title"><?php echo $a['about_title'] ?></h4>
                  <p class="card-text" style="font-size: 15px">
                    <?php echo $a['about_description'] ?>
                  </p>
                      
                </div>
                
              </div>
            </div>
          </div>
           <?php } ?>

         
        </div>
      </div>
    </div>

    <div class="container-fluid py-5" id="menu">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h5 class="section-title text-center text-danger fw-normal">
            Pizza Menu
          </h5>
          <h1 class="mb-5" style="font-weight: bold">Most Popular Items</h1>
        </div>
        <div class="tab-class text-center">

  <!-- Category tabs -->
  <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
    <?php foreach ($categories as $index => $category) { ?>
      <li class="nav-item">
        <a class=" nav-link link2 <?php echo $index === 0 ? 'active' : ''; ?>"
           data-bs-toggle="pill"
           href="#category-<?php echo $category['category_id']; ?>">
          <?php echo htmlspecialchars($category['category_name']); ?>
        </a>
      </li>
    <?php } ?>
  </ul>

  <!-- Pizzas for each category -->
  <div class="tab-content">
    <?php foreach ($categories as $index => $category) { ?>

      <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>"
           id="category-<?php echo $category['category_id']; ?>">

        <div class="row g-4">

          <?php
          $categoryId = (int)$category['category_id'];

          $sql = "SELECT * FROM pizzas
                  WHERE category_id = $categoryId
                  ";

          $result = $conn->query($sql);

          while ($pizza = $result->fetch_assoc()) {
          ?>

            <div class="col-lg-6">
              <div class="d-flex align-items-center">
                <img
                  class="flex-shrink-0 img-fluid rounded"
                  src="../Admin page/uploads/pizza bite/<?php echo htmlspecialchars($pizza['pizza_image']); ?>"
                  alt="<?php echo htmlspecialchars($pizza['pizza_name']); ?>"
                  style="width: 170px"
                />

                <div class="w-100 d-flex flex-column text-start ps-4">
                  <h5 class="d-flex justify-content-between border-bottom pb-2">
                    <span><?php echo htmlspecialchars($pizza['pizza_name']); ?></span>
                    <span class="text-danger"><?php echo htmlspecialchars($pizza['pizza_price']); ?></span>
                  </h5>

                  <small class="fst-italic">
                    <?php echo htmlspecialchars($pizza['pizza_description']); ?>
                  </small>
                </div>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>

    <?php } ?>
  </div>
</div>
      </div>
    </div>

    <div class="container-fluid bg-light" id="contact">
      <div class="row bg-light">
        <div class="col-md-3 mt-5">
          <p>Quick Links</p>
          <ul>
            <li><a href="#home" class="link1">Home</a></li>
            <li><a href="#menu" class="link1">Menu</a></li>
            <li><a href="#about" class="link1">About</a></li>
            <li>
              <a href=""
                ><img
                  class="img-fluid"
                  src="Images/62588-and-icons-facebook-computer-black-logo-white.png"
                  style="width: 40px"
                  alt=""
              /></a>
              <a href=""
                ><img
                  src="Images/1-13374_instagram-icon-new-black-background-vector-logo-instagram.png"
                  style="width: 26px"
                  class="img-fluid"
                  alt=""
              /></a>
            </li>
          </ul>
        </div>

        <div class="col-md-3 mt-5">
          <p>Contact Us</p>
          <img
            class="img-fluid"
            alt=""
            src="Images/location_on_24dp_000000_FILL0_wght400_GRAD0_opsz24.png"
          />
          <span>Beirut, Lebanon</span> <br />
          <img
            class="img-fluid"
            src="Images/phone_in_talk_24dp_000000_FILL0_wght400_GRAD0_opsz24.png"
            alt=""
          />
          <span>+961 79 174 215</span><br />
          <img
            class="img-fluid"
            src="Images/alternate_email_24dp_000000_FILL0_wght400_GRAD0_opsz24.png"
            alt=""
          />
          <span>hasan.hamdan0718@gmail.com</span><br />
          <img
            class="img-fluid"
            src="Images/schedule_24dp_000000_FILL0_wght400_GRAD0_opsz24.png"
            alt=""
          />
          <span>Mon-Sun 11:00 AM- 11:00 PM</span>
        </div>

        <div class="col-md-3 mt-5">
          <p>Send Us a Message</p>
          <form action="">
            <input
              type="text"
              placeholder="Name"
              class="input1 mb-2"
              required
              autocomplete="off"
            /><br />
            <input
              type="text"
              placeholder="Email"
              class="input1 mb-2"
              required
              autocomplete="off"
            /><br />
            <textarea
              name=""
              id=""
              placeholder="Messgae"
              class="input1 mb-2"
              required
              autocomplete="off"
            ></textarea>
            <br />
            <input
              type="submit"
              name=""
              id=""
              value="submit"
              class="btn1 mb-2"
            />
          </form>
        </div>
      </div>
      <hr />
      <div class="me-5 container-fluid">
        <p style="text-align: center">
          &copy; 2026 Pizza Bite. All rights reserved.
        </p>
      </div>
    </div>
  </body>
</html>
