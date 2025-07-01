  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark  sticky-top  px-5">
    <a class="navbar-brand" href="index.php"><i class="fa fa-calendar-check me-3"></i>Event Planner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-start" id="navbarResponsive">
      <p class=" text-danger mt-2 pt-2"> Welcome <b><?=(isset($_SESSION['SESS_NAME'])?ucfirst($_SESSION['SESS_UTYPE'])." (".ucfirst($_SESSION['SESS_NAME']).")":"Visitor")?></b> </p>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav mx-auto">
        <a class="nav-link active" href="index.php">Home</a>
        <?php if (isset($_SESSION['USER_TYPE'])): ?>
          <?php if($_SESSION['USER_TYPE']==0): ?>
            <a class="nav-link active" href="users.php">Users</a>
            <a class="nav-link active" href="categories.php">Categories</a>
            <a class="nav-link active" href="events.php">Events</a>
            <a class="nav-link active" href="contact-us.php">Contact</a>
            <a class="nav-link active" href="subscribers.php">Subscribers</a>
          <?php elseif($_SESSION['USER_TYPE']==1): ?>
            <a class="nav-link active" href="profile.php">Profile</a>
            <a class="nav-link active" href="events.php">Events</a>
            <a class="nav-link active" href="email.php">Subscribe</a>
          <?php endif ?>
            <a class="nav-link active" href="logout.php">logout</a>
          <?php else: ?>
            <a class="nav-link active" href="#about">AboutUs</a>
            <a class="nav-link active" href="#contact">ContactUs</a>
            <a class="nav-link active" href="events.php">Events</a>
            <a class="nav-link active" href="login.php">Login</a>
            <a class="nav-link active" href="register.php">Register</a>
          <?php endif ?>
      </div>
    </nav>
    <!-- Navigation -->