<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="stylesheet/style.css" />
  <link rel="shortcut icon" href="img/Union.png" />
  <script src="js/script.js"></script>
  <title>Pineapple</title>
</head>

<body>
  <div class="main">
    <div class="section1">
      <div class="navbar">
        <div class="logoSection">
          <img src="img/Union.png" alt="logo" />
          <h2>pineapple.</h2>
        </div>

        <div class="linkSection">
          <nav>
            <ul>
              <li><a href="#"> About </a></li>
              <li><a href="#"> How It works </a></li>
              <li><a href="#"> Contact </a></li>
            </ul>
          </nav>
        </div>
      </div>
      <div id="partOne" class="partOne">
        <h2>Subscribe to our newsletter</h2>
        <p>
          Subscribe to our newsletter and get 20% disccount on pineapple
          glasses
        </p>
      </div>
      <div class="partTwo">
        <form action="conn.php" method="POST">
          <div id="form">
            <div class="emailBox">
              <input type="text" id="email" name="email" placeholder="Type your email here..." onkeyup="validateEmail()" />
              <button type="submit" name="submitEmail" class="submitBtn">
                <span class="fa fa-arrow-right"> </span>
              </button>
            </div>
            <div class="checkBoxSection">
              <span class="error" id="error">
                <?php if (isset($_GET['error'])) {
                  echo "<li>" . $_GET['error'] . "</li>";
                } ?>
              </span>
              <input id="policy" name="policy" type="checkbox" required />
              <label for="policy">
                I agree to <u><b> terms of service </b></u>
              </label>
              <span class="error" id="error2"></span>
            </div>
            <hr class="solid" />
          </div>
        </form>

        <div id="success">
          <h1>Thanks for submiting</h1>
          <p>You are successfully subscribe to our newsletter</p>
          <p>Check your email account for discount codes</p>
          <br />
          <br />
          <hr />
        </div>

        <div class="partThree">
          <ul class="social">
            <li>
              <a class="fb" href="#">
                <span class="fa fa-facebook"></span>
              </a>
            </li>
            <li>
              <a class="instagram" href="#">
                <span class="fa fa-instagram"></span>
              </a>
            </li>
            <li>
              <a class="twitter" href="#">
                <span class="fa fa-twitter"></span>
              </a>
            </li>
            <li>
              <a class="yt" href="#">
                <span class="fa fa-youtube"></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="section2">
      <img class="mainPic" src="img/image_summer.png" alt="Pineapple" />
    </div>
  </div>
</body>

</html>